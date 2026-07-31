<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Setup Awal: Zona Waktu dan Locale
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID');
        
        $sekarang = Carbon::now('Asia/Jakarta');
        $hariIni = $sekarang->locale('id')->translatedFormat('l');
        $jamSekarangFormat = $sekarang->format('H:i');

        $data = [];
        $user = Auth::user();
        
        // 2. Logika Ruangan Terpakai (PENTING)
        // Kita menggunakan REPLACE untuk mengubah format database "08.00" menjadi "08:00"
        // agar bisa dibandingkan secara matematis dengan waktu sistem.
        $hariInggris = strtolower($sekarang->format('l'));
        // Cek nama hari dalam 2 bahasa (Inggris & Indonesia) karena ada data lama
        // yang formatnya tidak konsisten.
        $jadwalHariIniAll = Jadwal::whereRaw('LOWER(hari) IN (?, ?)', [$hariInggris, strtolower($hariIni)])->get();
        
        $data['ruanganTerpakai'] = $jadwalHariIniAll->filter(function ($jadwal) use ($sekarang) {
            // Bersihkan spasi dan pecah jam (mendukung format "14.00 - 15.40" maupun "14.00-15.40")
            $jamParts = explode('-', str_replace(' ', '', $jadwal->jam));
            if (count($jamParts) == 2) {
                $mulai = Carbon::createFromTimeString(str_replace('.', ':', $jamParts[0]));
                $selesai = Carbon::createFromTimeString(str_replace('.', ':', $jamParts[1]));
                return $sekarang->between($mulai, $selesai);
            }
            return false;
        });
        
        // 3. Logika Jadwal Terbaru
        $data['jadwalTerbaru'] = Jadwal::where('updated_at', '>=', now()->subDay())
            ->latest('updated_at')
            ->take(5)
            ->get();

        // 4. Logika Spesifik Berdasarkan Role
        if ($user && $user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            $data['mahasiswa'] = $mahasiswa;

            // Nilai default aman — dipakai kalau akun mahasiswa ini belum terhubung
            // ke tabel `mahasiswas` (user_id belum terisi), supaya dashboard.blade.php
            // tidak error karena variabel-variabel ini tidak pernah ter-set.
            $data['totalSksHariIni'] = 0;
            $data['totalMatkulHariIni'] = 0;
            $data['matkulSelesai'] = 0;
            $data['jadwalBerikutnya'] = null;
            $data['detikMenujuKelas'] = 0;
            $data['semesterRomawi'] = '-';
            $data['jadwalHariIni'] = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 5, request()->get('page', 1), ['path' => request()->url()]);

            if ($mahasiswa) {
                // Konversi semester mahasiswa (angka: 1,2,3...) ke romawi (I, II, III...)
                // supaya bisa dicocokkan dengan kolom jadwals.semester yang formatnya romawi.
                $semesterMap = ['1' => 'I', '2' => 'II', '3' => 'III', '4' => 'IV', '5' => 'V', '6' => 'VI', '7' => 'VII', '8' => 'VIII'];
                $semesterRomawi = $semesterMap[$mahasiswa->semester] ?? $mahasiswa->semester;
                $data['semesterRomawi'] = $semesterRomawi;

                // Ambil jadwal mahasiswa hari ini — HARUS cocok jurusan & semester-nya,
                // bukan cuma kelas. Kelas 'Gabungan' tetap ikut ditampilkan karena itu
                // jadwal yang berlaku untuk kelas A maupun B sekaligus.
                $jadwalQuery = Jadwal::with('dosen')
                    ->where('jurusan', $mahasiswa->jurusan)
                    ->where('semester', $semesterRomawi)
                    ->where(function ($query) use ($mahasiswa) {
                        $query->where('kelas', $mahasiswa->kelas)
                              ->orWhere('kelas', 'Gabungan');
                    })
                    ->where('hari', $hariIni)
                    ->orderBy('jam', 'asc');

                $jadwalHariIni = $jadwalQuery->get()->map(function ($jadwal) use ($sekarang) {
                    // Parsing jam yang aman terhadap format "08.00-10.30" (tanpa spasi,
                    // dipakai data hasil seeder) maupun "08.00 - 10.30" (dengan spasi,
                    // dipakai form booking ruangan). Kalau formatnya tidak sesuai
                    // ekspektasi, jam_mulai/jam_selesai di-null-kan (bukan crash).
                    $jamBersih = str_replace(' ', '', $jadwal->jam ?? '');
                    $jamParts = explode('-', $jamBersih);

                    if (count($jamParts) === 2 && trim($jamParts[0]) !== '' && trim($jamParts[1]) !== '') {
                        try {
                            $jadwal->jam_mulai = Carbon::createFromTimeString(str_replace('.', ':', $jamParts[0]));
                            $jadwal->jam_selesai = Carbon::createFromTimeString(str_replace('.', ':', $jamParts[1]));
                        } catch (\Exception $e) {
                            $jadwal->jam_mulai = null;
                            $jadwal->jam_selesai = null;
                        }
                    } else {
                        $jadwal->jam_mulai = null;
                        $jadwal->jam_selesai = null;
                    }

                    // Hitung status (Akan Datang / Berjalan / Selesai) untuk badge di tabel
                    // dashboard mahasiswa. Sebelumnya field ini tidak pernah di-set, sehingga
                    // badge status selalu tampil kosong.
                    if ($jadwal->jam_mulai && $jadwal->jam_selesai) {
                        if ($sekarang->lt($jadwal->jam_mulai)) {
                            $jadwal->status = 'Akan Datang';
                            $jadwal->status_class = 'info';
                        } elseif ($sekarang->between($jadwal->jam_mulai, $jadwal->jam_selesai)) {
                            $jadwal->status = 'Berjalan';
                            $jadwal->status_class = 'success pulsing';
                        } else {
                            $jadwal->status = 'Selesai';
                            $jadwal->status_class = 'gray-badge';
                        }
                    } else {
                        $jadwal->status = '-';
                        $jadwal->status_class = '';
                    }

                    return $jadwal;
                });

                // Kalkulasi data statistik mahasiswa
                $data['totalSksHariIni'] = $jadwalHariIni->sum('sks');
                $data['totalMatkulHariIni'] = $jadwalHariIni->count();
                $data['matkulSelesai'] = $jadwalHariIni->filter(fn($j) => $j->jam_selesai && $j->jam_selesai->lt($sekarang))->count();

                // Cari jadwal berikutnya (yang jam_mulai-nya valid dan belum lewat)
                $data['jadwalBerikutnya'] = $jadwalHariIni->filter(fn($j) => $j->jam_mulai && $j->jam_mulai->gt($sekarang))->sortBy('jam_mulai')->first();
                $data['detikMenujuKelas'] = $data['jadwalBerikutnya'] ? $sekarang->diffInSeconds($data['jadwalBerikutnya']->jam_mulai, false) : 0;

                // Paginate the collection manually for the view
                $data['jadwalHariIni'] = new \Illuminate\Pagination\LengthAwarePaginator($jadwalHariIni->forPage(request()->get('page', 1), 5), $jadwalHariIni->count(), 5, request()->get('page', 1), ['path' => request()->url()]);
            }
        } else {
            // Default untuk Dosen/Admin
            // Kirim koleksi LENGKAP (bukan hasil paginate) — pagination sekarang ditangani
            // di sisi client (JS), persis seperti pola halaman Dosen (window.dosenDariDatabase).
            $data['jadwalHariIni'] = Jadwal::with('dosen')->where('hari', $hariIni)->orderBy('jam', 'asc')->get();
            $data['totalDosen'] = Dosen::count();
            $data['totalMatkul'] = Jadwal::distinct('matakuliah')->count('matakuliah');
            $data['totalRuangan'] = Jadwal::whereNotNull('ruang')->whereNotIn('ruang', ['-', 'Online', 'Daring'])->distinct('ruang')->count('ruang');
        }

        // 5. Data Grafik (Statis/Agregasi) - Dioptimalkan menjadi 1 query
       $grafikDataRaw = Jadwal::select('hari', DB::raw('count(*) as total'))
            ->groupBy('hari')
            ->pluck('total', 'hari');

        $rekapHari = ['Senin' => 0, 'Selasa' => 0, 'Rabu' => 0, 'Kamis' => 0, 'Jumat' => 0];

        foreach ($grafikDataRaw as $hariDb => $total) {
            $hariNormal = strtolower(trim($hariDb));
            
            // Cocokkan data (mendukung campuran bahasa Inggris & Indonesia di Database)
            if (in_array($hariNormal, ['monday', 'senin'])) $rekapHari['Senin'] += $total;
            elseif (in_array($hariNormal, ['tuesday', 'selasa'])) $rekapHari['Selasa'] += $total;
            elseif (in_array($hariNormal, ['wednesday', 'rabu'])) $rekapHari['Rabu'] += $total;
            elseif (in_array($hariNormal, ['thursday', 'kamis'])) $rekapHari['Kamis'] += $total;
            elseif (in_array($hariNormal, ['friday', 'jumat'])) $rekapHari['Jumat'] += $total;
        }

        $data['grafikLabels'] = array_keys($rekapHari);
        $data['grafikData'] = array_values($rekapHari);

        return view('dashboard', $data);
    }
}