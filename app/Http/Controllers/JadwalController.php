<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Events\JadwalDiperbarui;

class JadwalController extends Controller
{
    /**
     * Aturan validasi dipakai bersama oleh store() dan update()
     * supaya konsisten dan tidak duplikat.
     */
    private function rules(): array
    {
        return [
            'hari'       => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam'        => 'required|string|max:20',
            'kode_jam'   => 'required|string|max:10',
            'matakuliah' => 'required|string|max:255',
            'kelas'      => 'required|string|max:50',
            'sks'        => 'required|integer|min:1|max:6',
            'dosen_id'   => 'nullable|exists:dosens,id',
            'semester'   => 'required|string|max:10',
            'ruang'      => 'required|string|max:50',
            'jurusan'    => 'required|string|max:100',
        ];
    }

    /**
     * Tentukan kategori semester (Ganjil/Genap) dari nilai semester yang
     * tersimpan (mis. "I", "III", "V", "VII" = Ganjil; "II", "IV", "VI",
     * "VIII" = Genap). Dipakai supaya jadwal Ganjil dan Genap tidak
     * dianggap bentrok satu sama lain walau hari/jam/ruangnya sama —
     * keduanya jalan di periode yang berbeda jadi tidak pernah tabrakan
     * beneran.
     */
    private function kategoriSemester(string $semester): string
    {
        $ganjil = ['I', 'III', 'V', 'VII', '1', '3', '5', '7'];
        return in_array(strtoupper(trim($semester)), $ganjil, true) ? 'Ganjil' : 'Genap';
    }

    /**
     * Daftar nilai semester yang termasuk kategori yang sama dengan
     * $semester, dipakai untuk membatasi query bentrok hanya ke jadwal
     * di kategori (periode) yang sama.
     */
    private function semesterSekategori(string $semester): array
    {
        $ganjil = ['I', 'III', 'V', 'VII', '1', '3', '5', '7'];
        $genap  = ['II', 'IV', 'VI', 'VIII', '2', '4', '6', '8'];
        return $this->kategoriSemester($semester) === 'Ganjil' ? $ganjil : $genap;
    }

    /**
     * Bersihkan input teks yang dipakai sebagai kunci pembanding bentrok
     * (hari, jam, ruang) supaya spasi ekstra / selisih kapitalisasi kecil
     * tidak bikin dua jadwal yang sebenarnya sama dianggap berbeda.
     * Ini yang bikin baris "I/2" vs " I/2 " lolos dari pengecekan lama.
     */
    private function normalisasi(array $data): array
    {
        $data['hari']  = trim($data['hari']);
        $data['jam']   = trim($data['jam']);
        $data['ruang'] = trim($data['ruang']);
        return $data;
    }

    /**
     * Cek bentrok Ruangan (ruang yang sama dipakai di hari+jam yang sama)
     * dan bentrok Dosen (dosen yang sama mengajar di hari+jam yang sama,
     * meski ruangnya beda — satu dosen tidak mungkin mengajar 2 kelas
     * sekaligus).
     *
     * Perbandingan hari/jam/ruang pakai whereRaw + TRIM + LOWER supaya
     * konsisten walau ada perbedaan kapitalisasi atau spasi tersembunyi
     * di data lama yang sudah kadung tersimpan sebelum normalisasi ini ada.
     */
    private function cekBentrok(array $validated, ?int $kecualiId = null): ?string
    {
        $semesterSekategori = array_map('strtoupper', $this->semesterSekategori($validated['semester']));

        $baseRuang = Jadwal::whereRaw('LOWER(TRIM(hari)) = ?', [strtolower($validated['hari'])])
            ->whereRaw('LOWER(TRIM(jam)) = ?', [strtolower($validated['jam'])])
            ->whereRaw('LOWER(TRIM(ruang)) = ?', [strtolower($validated['ruang'])])
            ->whereRaw('UPPER(TRIM(semester)) IN (' . implode(',', array_fill(0, count($semesterSekategori), '?')) . ')', $semesterSekategori);

        if ($kecualiId) {
            $baseRuang->where('id', '!=', $kecualiId);
        }

        if ($baseRuang->exists()) {
            return "Ruangan {$validated['ruang']} sudah dipakai jadwal lain pada hari {$validated['hari']} jam {$validated['jam']} (semester {$this->kategoriSemester($validated['semester'])})!";
        }

        // Cek bentrok dosen hanya jika dosen_id memang diisi
        if (!empty($validated['dosen_id'])) {
            $baseDosen = Jadwal::whereRaw('LOWER(TRIM(hari)) = ?', [strtolower($validated['hari'])])
                ->whereRaw('LOWER(TRIM(jam)) = ?', [strtolower($validated['jam'])])
                ->whereRaw('UPPER(TRIM(semester)) IN (' . implode(',', array_fill(0, count($semesterSekategori), '?')) . ')', $semesterSekategori)
                ->where('dosen_id', $validated['dosen_id']);

            if ($kecualiId) {
                $baseDosen->where('id', '!=', $kecualiId);
            }

            if ($baseDosen->exists()) {
                $namaDosen = optional(Dosen::find($validated['dosen_id']))->nama ?? 'Dosen tersebut';
                return "{$namaDosen} sudah memiliki jadwal mengajar lain pada hari {$validated['hari']} jam {$validated['jam']} (semester {$this->kategoriSemester($validated['semester'])})!";
            }
        }

        return null; // tidak ada bentrok
    }

    public function index()
    {
        // Urutan hari bukan alfabet (Senin, Selasa, ..., Jumat), jadi
        // dipetakan manual lewat CASE WHEN supaya tabel terbaca seperti
        // timetable asli, bukan urutan input/alfabet.
        $urutanHari = "CASE
            WHEN hari = 'Senin' THEN 1
            WHEN hari = 'Selasa' THEN 2
            WHEN hari = 'Rabu' THEN 3
            WHEN hari = 'Kamis' THEN 4
            WHEN hari = 'Jumat' THEN 5
            ELSE 6
        END";

        // with('dosen') agar data nama dosen ikut terbawa ke frontend.
        // Setelah hari, urutkan berdasarkan jam mulai. Format jam
        // (mis. "08.00-09.40") selalu 2 digit di depan (zero-padded),
        // jadi urutan teks otomatis sama dengan urutan waktu asli —
        // tidak perlu parsing jam secara manual.
        $jadwals = Jadwal::with('dosen')
            ->orderByRaw($urutanHari)
            ->orderBy('jam')
            ->get();
        $dosens = Dosen::all();

        return view('jadwal', compact('jadwals', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $this->normalisasi($request->validate($this->rules()));

        $pesanBentrok = $this->cekBentrok($validated);
        if ($pesanBentrok) {
            return response()->json(['success' => false, 'message' => $pesanBentrok], 422);
        }

        $jadwal = Jadwal::create($validated);

        $jadwal->load('dosen');

        event(new JadwalDiperbarui());

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil dibuat!',
            'data'    => $jadwal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $validated = $this->normalisasi($request->validate($this->rules()));

        $pesanBentrok = $this->cekBentrok($validated, (int) $id);
        if ($pesanBentrok) {
            return response()->json(['success' => false, 'message' => $pesanBentrok], 422);
        }

        $jadwal->update($validated);

        // Muat relasi dosen (siapa tahu dosen_id berubah) agar nama terbaru ikut terbawa
        $jadwal->load('dosen');

        event(new JadwalDiperbarui());

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diubah!',
            'data'    => $jadwal,
        ]);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan!'], 404);
        }

        $jadwal->delete();

        // Panggil event (opsional jika Anda pakai websocket)
        event(new JadwalDiperbarui());

        return response()->json(['success' => true, 'message' => 'Jadwal berhasil dihapus!']);
    }
}