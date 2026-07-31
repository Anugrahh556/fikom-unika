<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\JadwalDiperbarui; // 1. Tambahkan use statement untuk Event
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Dosen;

class RuanganController extends Controller
{
    // --- 1. FUNGSI TAMPILAN HALAMAN UTAMA ---
    public function index()
    {
        $tableName = 'jadwals';
        $ruangan = [];
        $masterJadwal = [
            'Senin' => [], 'Selasa' => [], 'Rabu' => [], 'Kamis' => [], 'Jumat' => []
        ];

        if (Schema::hasTable($tableName)) {
            // Mengambil daftar ruangan unik dari database (kecuali yang online/daring)
            $ruanganRaw = DB::table($tableName)
                ->whereNotNull('ruang')
                ->whereNotIn('ruang', ['-', 'Online', 'Daring', 'TBD'])
                ->distinct()
                ->pluck('ruang');

            $ruangan = $ruanganRaw->map(function ($ruang) {
                return trim(preg_replace('/Lab[\s\-\.]*([A-Za-z])/i', 'Lab. $1', $ruang));
            })->unique()->values()->toArray();

            $jadwalData = DB::table($tableName)
                ->leftJoin('dosens', 'jadwals.dosen_id', '=', 'dosens.id')
                ->select('jadwals.*', 'dosens.nama as dosen_nama')
                ->get();

            foreach ($jadwalData as $j) {
                $hariMentah = $j->hari ?? 'TIDAK_DIKETAHUI'; 
                $hariAman = ucfirst(strtolower(trim($hariMentah)));

                if (!isset($masterJadwal[$hariAman])) {
                    $masterJadwal[$hariAman] = [];
                }

                $masterJadwal[$hariAman][] = [
                    'ruang' => trim(preg_replace('/Lab[\s\-\.]*([A-Za-z])/i', 'Lab. $1', $j->ruang ?? '')),
                    'jam' => $j->jam ?? '-',
                    'matkul' => $j->matakuliah ?? ($j->matkul ?? '-'),
                    'dosen' => $j->dosen_nama ?? '-',
                    'sks' => $j->sks ?? 3, 
                    'kelas' => $j->kelas ?? '-',
                    'jurusan' => $j->jurusan ?? 'Fakultas Ilmu Komputer',
                ];
            }
        } 

        if (empty($ruangan)) {
            $ruangan = ["1/1", "1/2", "1/3", "1/4", "1/5", "1/6", "1/7", "II/1", "II/2", "III/1", "III/2", "Lab. A", "Lab. B", "Lab. C", "Lab. D", "Lab. E", "Lab. F", "Lab. G"];
        }

        // --- LOGIKA NOTIFIKASI ---
        // Mengambil 5 aktivitas jadwal terbaru (baru dibuat atau diperbarui) dari 24 jam terakhir
        $jadwalTerbaru = DB::table($tableName)
            ->where('updated_at', '>=', now()->subDay())
            ->latest('updated_at')
            ->take(5)
            ->get();

        $dosens = Dosen::where('status', '!=', 'Tidak Aktif')->orderBy('nama')->get(['nama']);

        return view('ruangan', compact('ruangan', 'masterJadwal', 'jadwalTerbaru', 'dosens'));
    }

    // --- 2. FUNGSI MENYIMPAN BOOKING RUANGAN DARURAT ---
    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|string',
            'ruang' => 'required|string',
            'dosen' => 'required|string',
            'matkul' => 'required|string',
            'jam' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|string',
            'jurusan' => 'required|string',
            'kelas' => 'required|string',
        ]);

        try {
            // Cari dosen berdasarkan nama persis yang dikirim dari dropdown form
            $dosenTerpilih = Dosen::where('nama', $validated['dosen'])->first();

            if (!$dosenTerpilih) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nama dosen tidak ditemukan di data dosen aktif. Silakan pilih ulang dari daftar dropdown.'
                ], 422);
            }

            $kamusKodeJam = [
                '08.00 - 09.40' => 'AB', '08.00 - 10.30' => 'ABC', '09.50 - 11.30' => 'CD',
                '09.50 - 12.20' => 'CDE', '10.40 - 12.20' => 'DE', '10.40 - 13.10' => 'DEF',
                '11.40 - 13.20' => 'EF', '14.00 - 15.40' => 'GH', '14.00 - 16.30' => 'GHI',
                '15.50 - 17.30' => 'IJ', '15.50 - 18.20' => 'IJK', '16.40 - 18.20' => 'JK', '16.40 - 19.10' => 'JKL'
            ];

            $kodeJamTerpilih = $kamusKodeJam[$validated['jam']] ?? '-';

            $dataInsert = [
                'hari' => $validated['hari'],
                'ruang' => $validated['ruang'],
                'dosen_id' => $dosenTerpilih->id,
                'matakuliah' => $validated['matkul'] . ' [Booking]', 
                'jam' => $validated['jam'],
                'kode_jam' => $kodeJamTerpilih, 
                'sks' => $validated['sks'],
                'semester' => $validated['semester'],
                'jurusan' => $validated['jurusan'],
                'kelas' => $validated['kelas'],
            ];

            DB::table('jadwals')->insert($dataInsert);
            
            // 2. Panggil event setelah data berhasil disimpan
            broadcast(new JadwalDiperbarui("Ruangan telah di-booking", $validated['matkul']))->toOthers();

            return response()->json([
                'success' => true, 
                'message' => 'Ruangan berhasil diambil!'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal booking ruangan: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan sistem saat menyimpan booking. Silakan coba lagi atau hubungi admin.'
            ], 500);
        }
    }

    // --- 3. FUNGSI MEMBATALKAN/MENGHAPUS BOOKING ---
    public function cancelBooking(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'ruang' => 'required|string',
            'matkul' => 'required|string',
        ]);

        try {
            // Escape karakter wildcard LIKE (% dan _) supaya nama matkul yang mengandung
            // karakter tersebut tidak menghasilkan pencocokan yang salah/tidak terduga.
            $matkulAman = str_replace(['%', '_'], ['\\%', '\\_'], $request->matkul);

            // Menghapus dari database berdasarkan Hari, Ruangan, dan Nama Matkul
            $deleted = DB::table('jadwals')
                ->where('hari', $request->hari)
                ->where('ruang', $request->ruang)
                ->where('matakuliah', 'like', $matkulAman . '%')
                ->delete();

            if ($deleted) {
                // 3. Panggil event setelah data berhasil dihapus
                broadcast(new JadwalDiperbarui("Booking dibatalkan", $request->matkul))->toOthers();

                return response()->json([
                    'success' => true, 
                    'message' => 'Jadwal berhasil dibatalkan dan ruangan telah dikosongkan.'
                ]);
            } else {
                return response()->json([
                    'success' => false, 
                    'message' => 'Jadwal tidak ditemukan di database (kemungkinan ini adalah jadwal permanen).'
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal membatalkan booking: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan sistem saat menghapus booking. Silakan coba lagi atau hubungi admin.'
            ], 500);
        }
    }
}