<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

/**
 * ====================================================================
 * PENTING — BACA SEBELUM RUN:
 * Data ini dibaca dari FOTO tulisan tangan/tabel jadwal (bukan PDF asli),
 * jadi risiko salah baca cukup tinggi, terutama pada:
 *   - Kolom Dsn (nomor dosen kecil) -> sudah dipetakan ke dosen_id ASLI
 *     di DosenSeeder (bukan nomor mentah dari foto). Baris yang saya
 *     kurang yakin diberi komentar // CEK ULANG.
 *   - Kolom Ruang & Sem yang tulisannya kecil/rapat.
 * Mapping nomor legenda foto -> dosen_id:
 *   1->3, 2->4, 3->5, 4->6, 5->7(nonaktif), 6->2, 7->8, 8->9, 9->1,
 *   10->10, 11->11, 12->12, 13->13, 14->14, 15->15, 16->16, 17->17,
 *   18->18, 19->19, 20->20, 21->27, 22->28, 23->29, 24->30, 25->21,
 *   26->31, 27->32, 28->33, 29->34, 30->35, 31->36, 32->37, 33->38,
 *   34->39, 35->40, 36->41
 * Jalankan JadwalSeninSeeder HANYA setelah DosenSeeder (yang sudah
 * diperbarui dengan 15 dosen baru) dijalankan lebih dulu, supaya
 * foreign key dosen_id tidak gagal.
 * Semester di sini ditulis sesuai angka romawi yang tertulis di foto
 * (I, III, V, VII) — CEK ULANG apakah kolom `semester` di database
 * Anda mengharapkan format angka romawi atau angka biasa (1,3,5,7).
 * ====================================================================
 */
class JadwalSeninSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [

            // ================= TEKNIK INFORMATIKA S-1 =================
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Statistika', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 1,  'ruang' => '1/1', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Pemrosesan Bahasa Alami', 'kelas' => 'D', 'sks' => 2, 'dosen_id' => 17, 'ruang' => '1/7', 'semester' => 'VII', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Algoritma & Pemrograman', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 4,  'ruang' => '1/6', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Pemrograman Berorientasi Objek', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 6,  'ruang' => '1/2', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Sistem Basis Data', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 10, 'ruang' => '1/4', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Pemrograman Visual', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 9,  'ruang' => '1/5', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Pembangunan Data dan Pengetahuan', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 15, 'ruang' => 'Lab-A', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Pemrograman Berbasis Platform', 'kelas' => 'C', 'sks' => 3, 'dosen_id' => 16, 'ruang' => 'Lab-B', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'CD',  'matakuliah' => 'Pendidikan Pancasila', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 27, 'ruang' => '1/1', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Sistem Basis Data', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 10, 'ruang' => '1/4', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Pemrograman Berorientasi Objek', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 6,  'ruang' => 'III/1', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Prak. Rekayasa Perangkat Lunak', 'kelas' => 'D', 'sks' => 3, 'dosen_id' => 2,  'ruang' => 'Lab-D', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Prak. Pemrograman Visual', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 9,  'ruang' => 'Lab-A', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Prak. Pemrosesan Bahasa Alami', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 17, 'ruang' => 'Lab-G', 'semester' => 'VII', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Pengujian dan Implementasi Sistem', 'kelas' => 'D', 'sks' => 3, 'dosen_id' => 19, 'ruang' => '1/3', 'semester' => 'VII', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Jaringan Saraf Tiruan', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 3,  'ruang' => '1/6', 'semester' => 'VII', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Penambangan Data dan Pengetahuan', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 16, 'ruang' => '1/5', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Pemrograman Berbasis Platform', 'kelas' => 'C', 'sks' => 3, 'dosen_id' => 15, 'ruang' => '1/2', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Pendidikan Pancasila', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 27, 'ruang' => 'TBD', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'], // CEK ULANG: ruang tidak terbaca jelas di foto
            ['hari' => 'Senin', 'kode_jam' => 'EF',  'matakuliah' => 'Etika Profesi', 'kelas' => 'C', 'sks' => 2, 'dosen_id' => 5,  'ruang' => 'II/1', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Prak. Keamanan Sistem Basis Data Pilihan 1', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 4, 'ruang' => 'Lab-C', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'], // CEK ULANG: kode_jam & sks kurang jelas
            ['hari' => 'Senin', 'kode_jam' => 'IJK', 'matakuliah' => 'Prak. Pemrosesan Bahasa Alami', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 17, 'ruang' => 'Lab-B', 'semester' => 'VII', 'jurusan' => 'Teknik Informatika'], // CEK ULANG: kode_jam di foto tidak terbaca jelas, "IJK" (15.50-18.20) tebakan terdekat dari kode valid yang ada
            ['hari' => 'Senin', 'kode_jam' => 'JK',  'matakuliah' => 'Prak. Penambangan Data dan Pengetahuan', 'kelas' => 'E', 'sks' => 3, 'dosen_id' => 15, 'ruang' => 'Lab-G', 'semester' => 'V', 'jurusan' => 'Teknik Informatika'], // CEK ULANG: kode_jam di foto tidak terbaca jelas, "JK" (15.50-18.20) tebakan terdekat
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Statistika', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 1,  'ruang' => '1/3', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Bahasa Indonesia', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 33, 'ruang' => '1/5', 'semester' => 'I', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Pemrograman Berorientasi Objek', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 6,  'ruang' => 'Lab-B', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Sistem Basis Data', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 10, 'ruang' => 'Lab-A', 'semester' => 'III', 'jurusan' => 'Teknik Informatika'],

            // ================= SISTEM INFORMASI S-1 =================
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Pendidikan Kewarganegaraan', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 28, 'ruang' => '1/3', 'semester' => 'I', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Akuntansi Bisnis', 'kelas' => 'C', 'sks' => 3, 'dosen_id' => 36, 'ruang' => 'TBD', 'semester' => 'III', 'jurusan' => 'Sistem Informasi'], // CEK ULANG: ruang tidak terbaca jelas
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Bahasa Inggris Untuk Keperluan Akademis', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 30, 'ruang' => 'II/2', 'semester' => 'III', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Analisa & Perancangan SI', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 13, 'ruang' => 'Lab-E', 'semester' => 'III', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Multimedia Bisnis', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 12, 'ruang' => 'Lab-D', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Manajemen Proyek SI', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 14, 'ruang' => 'Lab-G', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Pilihan 3 (e-Governance)', 'kelas' => '-', 'sks' => 3, 'dosen_id' => 11, 'ruang' => 'III/1', 'semester' => 'VII', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Prak. Interaksi Manusia dan Komputer', 'kelas' => 'C', 'sks' => 2, 'dosen_id' => 2,  'ruang' => 'Lab-C', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Prak. Sistem Pendukung Keputusan(SPK)', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 8, 'ruang' => 'Lab-E', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Prak. Manajemen Proyek SI', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 14, 'ruang' => '1/7', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'E-Business', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => null, 'ruang' => 'Lab-C', 'semester' => 'TBD', 'jurusan' => 'Sistem Informasi'], // CEK ULANG: nomor Dsn & semester tidak terbaca sama sekali di foto
            ['hari' => 'Senin', 'kode_jam' => 'EF',  'matakuliah' => 'Sistem Operasi', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 20, 'ruang' => '1/3', 'semester' => 'III', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GH',  'matakuliah' => 'Pendidikan Kewarganegaraan', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 28, 'ruang' => '1/7', 'semester' => 'I', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GH',  'matakuliah' => 'Sistem Pendukung Keputusan(SPK)', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 8, 'ruang' => 'II/1', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GH',  'matakuliah' => 'Multimedia Bisnis', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 12, 'ruang' => '1/1', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Prak. Analisa Kinerja Sistem Informasi', 'kelas' => 'C', 'sks' => 2, 'dosen_id' => 11, 'ruang' => 'Lab-E', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Prak. Sistem Operasi', 'kelas' => 'C', 'sks' => 2, 'dosen_id' => 20, 'ruang' => 'Lab-D', 'semester' => 'III', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Prak. E-Business', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 13, 'ruang' => 'III/2', 'semester' => 'VII', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'IJK', 'matakuliah' => 'Multimedia Bisnis', 'kelas' => 'A', 'sks' => 2, 'dosen_id' => 12, 'ruang' => '1/1', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'], // CEK ULANG: kode_jam di foto tidak terbaca jelas, "IJK" tebakan terdekat
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Analisa Kinerja Sistem Informasi', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 11, 'ruang' => 'III/1', 'semester' => 'V', 'jurusan' => 'Sistem Informasi'],
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Algoritma & Pemrograman', 'kelas' => 'A', 'sks' => 3, 'dosen_id' => 4,  'ruang' => 'II/1', 'semester' => 'I', 'jurusan' => 'Sistem Informasi'], // CEK ULANG: ruang kemungkinan "I/1"
            ['hari' => 'Senin', 'kode_jam' => 'ABC', 'matakuliah' => 'Matematika Bisnis', 'kelas' => 'B', 'sks' => 3, 'dosen_id' => 31, 'ruang' => '1/6', 'semester' => 'I', 'jurusan' => 'Sistem Informasi'],

            // ================= SAINS DATA S-1 =================
            ['hari' => 'Senin', 'kode_jam' => 'CD',  'matakuliah' => 'Pendidikan Pancasila', 'kelas' => '-', 'sks' => 2, 'dosen_id' => 27, 'ruang' => 'TBD', 'semester' => 'I', 'jurusan' => 'Sains Data'], // CEK ULANG: ruang tidak terbaca
            ['hari' => 'Senin', 'kode_jam' => 'DEF', 'matakuliah' => 'Penambangan Data dan Pengetahuan', 'kelas' => '-', 'sks' => 3, 'dosen_id' => 13, 'ruang' => '1/2', 'semester' => 'III', 'jurusan' => 'Sains Data'], // CEK ULANG: nomor Dsn rapat, kurang yakin
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Keamanan Data', 'kelas' => '-', 'sks' => 3, 'dosen_id' => 11, 'ruang' => 'Lab-E', 'semester' => 'V', 'jurusan' => 'Sains Data'],
            ['hari' => 'Senin', 'kode_jam' => 'GHI', 'matakuliah' => 'Prak. Business Intelligence (Pilihan)', 'kelas' => '-', 'sks' => 3, 'dosen_id' => 17, 'ruang' => 'Lab-G', 'semester' => 'III', 'jurusan' => 'Sains Data'],
            ['hari' => 'Senin', 'kode_jam' => 'JK',  'matakuliah' => 'Prak. Teknologi Big Data dan Cloud', 'kelas' => '-', 'sks' => 3, 'dosen_id' => 12, 'ruang' => '1/1', 'semester' => 'V', 'jurusan' => 'Sains Data'], // CEK ULANG: kode_jam di foto tidak terbaca jelas, "JK" tebakan terdekat
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Bisnis Digital', 'kelas' => '-', 'sks' => 2, 'dosen_id' => 20, 'ruang' => '1/7', 'semester' => 'V', 'jurusan' => 'Sains Data'],
            ['hari' => 'Senin', 'kode_jam' => 'AB',  'matakuliah' => 'Bahasa Indonesia', 'kelas' => 'B', 'sks' => 2, 'dosen_id' => 33, 'ruang' => '1/5', 'semester' => 'I', 'jurusan' => 'Sains Data'],
        ];

        // Mapping kode_jam -> rentang jam sesuai daftar "Jam Perkuliahan" di halaman Jadwal
        $jamMap = [
            'AB'  => '08.00-09.40',
            'ABC' => '08.00-10.30',
            'CD'  => '09.50-11.30',
            'CDE' => '09.50-12.20',
            'DE'  => '10.40-12.20',
            'DEF' => '10.40-13.10',
            'EF'  => '11.40-13.20',
            'GH'  => '14.00-15.40',
            'GHI' => '14.00-16.30',
            'IJ'  => '15.50-17.30',
            'IJK' => '15.50-18.20',
            'JK'  => '15.50-18.20',
            'JKL' => '16.40-19.10',
        ];

        foreach ($jadwals as $j) {
            $j['jam'] = $jamMap[$j['kode_jam']] ?? null; // null jika kode_jam tidak dikenali (perlu CEK ULANG manual)
            Jadwal::create($j);
        }
    }
}