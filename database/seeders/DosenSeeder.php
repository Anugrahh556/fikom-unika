<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen; // Pastikan memanggil model Dosen dengan huruf kapital
use Illuminate\Support\Facades\Schema;

class DosenSeeder extends Seeder
{
     public function run(): void
    {
        // Nonaktifkan sementara pengecekan foreign key,
        // karena tabel jadwals mereferensikan tabel dosens (dosen_id)
        Schema::disableForeignKeyConstraints();

        // Bersihkan data lama agar tidak duplikat saat di-seed ulang
        Dosen::truncate();

        Schema::enableForeignKeyConstraints();

        $dataMaster = [
            ['id' => 1, 'nama' => 'Desinta Purba, ST, M.Kom', 'nidn' => '1000000001', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dekan', 'status' => 'Aktif', 'email' => 'desintapurba@gmail.com', 'phone' => '+62 813-6206-9808', 'foto' => 'https://i.pravatar.cc/150?img=5'],
            ['id' => 2, 'nama' => 'Andy Paul Harianja, ST, M.Kom', 'nidn' => '1000000002', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Wakil Dekan', 'status' => 'Aktif', 'email' => 'andypaul@ust.ac.id', 'phone' => '+62 812-3456-7890', 'foto' => 'https://i.pravatar.cc/150?img=6'],
            ['id' => 3, 'nama' => 'Prof. Dr. Zakarias Situmorang, MT', 'nidn' => '1000000003', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'zakarias@ust.ac.id', 'phone' => '+62 811-9876-5432', 'foto' => 'https://i.pravatar.cc/150?img=7'],
            ['id' => 4, 'nama' => 'Drs. Lamhot Sitorus, M.Kom', 'nidn' => '1000000004', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'lamhot@ust.ac.id', 'phone' => '+62 813-1111-2222', 'foto' => 'https://i.pravatar.cc/150?img=8'],
            ['id' => 5, 'nama' => 'Emerson P. Malau, S.Si, M.Kom', 'nidn' => '1000000005', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'emerson@ust.ac.id', 'phone' => '+62 852-3333-4444', 'foto' => 'https://i.pravatar.cc/150?img=9'],
            ['id' => 6, 'nama' => 'Parasian D.P. Silitonga, S.Kom, M.Cs', 'nidn' => '1000000006', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'parasian@ust.ac.id', 'phone' => '+62 812-5555-6666', 'foto' => 'https://i.pravatar.cc/150?img=11'],
            // CEK ULANG: dosen ini sudah tidak mengajar sesuai info pengguna — statusnya diubah,
            // ID TETAP DIPERTAHANKAN (tidak dihapus) supaya data historis lama yang mereferensikan id 7 tidak rusak.
            ['id' => 7, 'nama' => 'Doni El Rezen Purba, S.Kom., M.Kom', 'nidn' => '1000000007', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Tidak Aktif', 'email' => 'donipurba@ust.ac.id', 'phone' => '+62 853-7777-8888', 'foto' => 'https://i.pravatar.cc/150?img=12'],
            ['id' => 8, 'nama' => 'Wasit Ginting, S.Kom, M.Kom', 'nidn' => '1000000008', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'wasitginting@ust.ac.id', 'phone' => '+62 813-9999-0000', 'foto' => 'https://i.pravatar.cc/150?img=13'],
            ['id' => 9, 'nama' => 'Sorang Pakpahan, S.Kom, M.Kom', 'nidn' => '1000000009', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'sorang@ust.ac.id', 'phone' => '+62 812-1112-1113', 'foto' => 'https://i.pravatar.cc/150?img=14'],
            ['id' => 10, 'nama' => 'Masdiana Sagala, S.Kom, M.Kom', 'nidn' => '1000000010', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'masdiana@ust.ac.id', 'phone' => '+62 813-1415-1617', 'foto' => 'https://i.pravatar.cc/150?img=15'],
            ['id' => 11, 'nama' => 'Romanus Damanik, S.Kom, M.Kom', 'nidn' => '1000000011', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'romanus@ust.ac.id', 'phone' => '+62 852-1819-2021', 'foto' => 'https://i.pravatar.cc/150?img=16'],
            ['id' => 12, 'nama' => 'Dr. Tonni Limbong, S.Kom, M.Kom', 'nidn' => '1000000012', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'tonnilimbong@ust.ac.id', 'phone' => '+62 812-2223-2425', 'foto' => 'https://i.pravatar.cc/150?img=17'],
            ['id' => 13, 'nama' => 'Zekson Arizona Matondang, S.Kom, M.Kom', 'nidn' => '1000000013', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'zekson@ust.ac.id', 'phone' => '+62 813-2627-2829', 'foto' => 'https://i.pravatar.cc/150?img=18'],
            ['id' => 14, 'nama' => 'Alex Rikki, S.Kom., M.Kom', 'nidn' => '1000000014', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'alexrikki@ust.ac.id', 'phone' => '+62 852-3031-3233', 'foto' => 'https://i.pravatar.cc/150?img=19'],
            ['id' => 15, 'nama' => 'Sardo Sipayung, S.Kom., M.Kom', 'nidn' => '1000000015', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'sardosipayung@ust.ac.id', 'phone' => '+62 812-3435-3637', 'foto' => 'https://i.pravatar.cc/150?img=20'],
            ['id' => 16, 'nama' => 'Dr. Novri Siagian, S.Kom., M.Kom', 'nidn' => '1000000016', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'novrisiagian@ust.ac.id', 'phone' => '+62 813-3839-4041', 'foto' => 'https://i.pravatar.cc/150?img=21'],
            ['id' => 17, 'nama' => 'Anirma Kandida Ginting, S.Kom., M.Kom', 'nidn' => '1000000017', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'anirmaginting@ust.ac.id', 'phone' => '+62 852-4243-4445', 'foto' => 'https://i.pravatar.cc/150?img=22'],
            ['id' => 18, 'nama' => 'Dr. Paska Marto, S.Kom., M.Kom', 'nidn' => '1000000018', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'paskamarto@ust.ac.id', 'phone' => '+62 812-4647-4849', 'foto' => 'https://i.pravatar.cc/150?img=23'],
            ['id' => 19, 'nama' => 'Dr. Pandi Barita Nauli Simangunsong, S.Kom, M.Kom', 'nidn' => '1000000019', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'pandisimangunsong@ust.ac.id', 'phone' => '+62 813-5051-5253', 'foto' => 'https://i.pravatar.cc/150?img=24'],
            ['id' => 20, 'nama' => 'Lotar Mateus Sinaga, M.Kom', 'nidn' => '1000000020', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'lotarsinaga@ust.ac.id', 'phone' => '+62 852-5455-5657', 'foto' => 'https://i.pravatar.cc/150?img=25'],
            ['id' => 21, 'nama' => 'Swingly Purba, M.Sc', 'nidn' => '1000000021', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'swingly@ust.ac.id', 'phone' => '+62 812-5859-6061', 'foto' => 'https://i.pravatar.cc/150?img=26'],
            ['id' => 22, 'nama' => 'Justini Simanjuntak, S.Pd, M.Pd', 'nidn' => '1000000022', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'justini@ust.ac.id', 'phone' => '+62 813-6263-6465', 'foto' => 'https://i.pravatar.cc/150?img=27'],
            ['id' => 23, 'nama' => 'Pastor Blasius Ola Doren', 'nidn' => '1000000023', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'blasiusola@ust.ac.id', 'phone' => '+62 852-6667-6869', 'foto' => 'https://i.pravatar.cc/150?img=28'],
            ['id' => 24, 'nama' => 'Muhammad Akbar Siregar, S.H, M.Hum', 'nidn' => '1000000024', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'akbarsiregar@ust.ac.id', 'phone' => '+62 812-7071-7273', 'foto' => 'https://i.pravatar.cc/150?img=29'],
            ['id' => 25, 'nama' => 'Maranatha Purba, SH., M.H', 'nidn' => '1000000025', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'maranathapurba@ust.ac.id', 'phone' => '+62 813-7475-7677', 'foto' => 'https://i.pravatar.cc/150?img=30'],
            ['id' => 26, 'nama' => 'Yanti Vidarosa Naibaho, SS,.M.Hum', 'nidn' => '1000000026', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'yantinaibaho@ust.ac.id', 'phone' => '+62 852-7879-8081', 'foto' => 'https://i.pravatar.cc/150?img=31'],

            // =====================================================================
            // DOSEN BARU — ditambahkan dari legenda foto jadwal (No. 21-36), yang
            // sebelumnya belum ada di tabel dosens tapi dipakai di jadwal hari Senin.
            // CEK ULANG SEMUA: nidn, prodi, jabatan, email, phone di bawah ini
            // hanya PLACEHOLDER (mengikuti pola data lama). Wajib diganti dengan
            // data asli dosen yang bersangkutan sebelum dipakai di production.
            // =====================================================================
            ['id' => 27, 'nama' => 'Ica Karina, SH., M.Hum', 'nidn' => '1000000027', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'icakarina@ust.ac.id', 'phone' => '+62 812-0000-0027', 'foto' => 'https://i.pravatar.cc/150?img=32'], // CEK ULANG
            ['id' => 28, 'nama' => 'Sahata Manalu, SH, M.Hum', 'nidn' => '1000000028', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'sahatamanalu@ust.ac.id', 'phone' => '+62 812-0000-0028', 'foto' => 'https://i.pravatar.cc/150?img=33'], // CEK ULANG
            ['id' => 29, 'nama' => 'Rosa Maria Simamora, M.Hum', 'nidn' => '1000000029', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'rosamaria@ust.ac.id', 'phone' => '+62 812-0000-0029', 'foto' => 'https://i.pravatar.cc/150?img=34'], // CEK ULANG
            ['id' => 30, 'nama' => 'Jontra Pangaribuan, S.Pd., M.Pd', 'nidn' => '1000000030', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'jontrapangaribuan@ust.ac.id', 'phone' => '+62 812-0000-0030', 'foto' => 'https://i.pravatar.cc/150?img=35'], // CEK ULANG
            ['id' => 31, 'nama' => 'Drs. Israel Sitepu, M.Si', 'nidn' => '1000000031', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'israelsitepu@ust.ac.id', 'phone' => '+62 812-0000-0031', 'foto' => 'https://i.pravatar.cc/150?img=36'], // CEK ULANG
            ['id' => 32, 'nama' => 'Elisabeth Simangunsong, SE, M.Si', 'nidn' => '1000000032', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'elisabethsimangunsong@ust.ac.id', 'phone' => '+62 812-0000-0032', 'foto' => 'https://i.pravatar.cc/150?img=37'], // CEK ULANG
            ['id' => 33, 'nama' => 'Dairi Simanjuntak, S.Pd, M.Pd', 'nidn' => '1000000033', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'dairisimanjuntak@ust.ac.id', 'phone' => '+62 812-0000-0033', 'foto' => 'https://i.pravatar.cc/150?img=38'], // CEK ULANG — dikonfirmasi BEDA orang dari Justini Simanjuntak (id 22)
            ['id' => 34, 'nama' => 'P. Fiorensius Sipayung, OFM, Cap', 'nidn' => '1000000034', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'fiorensiussipayung@ust.ac.id', 'phone' => '+62 812-0000-0034', 'foto' => 'https://i.pravatar.cc/150?img=39'], // CEK ULANG
            ['id' => 35, 'nama' => 'Pani Romauli Elisabet Naibaho, SE, M.Si', 'nidn' => '1000000035', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'paninaibaho@ust.ac.id', 'phone' => '+62 812-0000-0035', 'foto' => 'https://i.pravatar.cc/150?img=40'], // CEK ULANG — dikonfirmasi BEDA orang dari Yanti Naibaho (id 26)
            ['id' => 36, 'nama' => 'Lamtiur Lidia Gultom, SE, M.Si', 'nidn' => '1000000036', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'lamtiurgultom@ust.ac.id', 'phone' => '+62 812-0000-0036', 'foto' => 'https://i.pravatar.cc/150?img=41'], // CEK ULANG
            ['id' => 37, 'nama' => 'Kolombus Siringo Ringo, ST, M.Kom', 'nidn' => '1000000037', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'kolombussiringo@ust.ac.id', 'phone' => '+62 812-0000-0037', 'foto' => 'https://i.pravatar.cc/150?img=42'], // CEK ULANG
            ['id' => 38, 'nama' => 'Saut M. Situmorang, ST, MT', 'nidn' => '1000000038', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'sautsitumorang@ust.ac.id', 'phone' => '+62 812-0000-0038', 'foto' => 'https://i.pravatar.cc/150?img=43'], // CEK ULANG
            ['id' => 39, 'nama' => 'Dr. Dewi Sartika Br. Ginting, S.Kom, M.Kom', 'nidn' => '1000000039', 'prodi' => 'Sistem Informasi', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'dewisartikaginting@ust.ac.id', 'phone' => '+62 812-0000-0039', 'foto' => 'https://i.pravatar.cc/150?img=44'], // CEK ULANG
            ['id' => 40, 'nama' => 'Pastor Yosep', 'nidn' => '1000000040', 'prodi' => 'Teknik Informatika', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'pastoryosep@ust.ac.id', 'phone' => '+62 812-0000-0040', 'foto' => 'https://i.pravatar.cc/150?img=45'], // CEK ULANG — dikonfirmasi BEDA orang dari Pastor Blasius Ola Doren (id 23)
            ['id' => 41, 'nama' => 'Liana, S.Pd, M.Pd', 'nidn' => '1000000041', 'prodi' => 'Sains Data', 'jabatan' => 'Dosen Tetap', 'status' => 'Aktif', 'email' => 'liana@ust.ac.id', 'phone' => '+62 812-0000-0041', 'foto' => 'https://i.pravatar.cc/150?img=46'], // CEK ULANG
        ];

        foreach ($dataMaster as $dosen) {
            Dosen::create($dosen);
        }
    }
}