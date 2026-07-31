<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RuanganController;

/*
|--------------------------------------------------------------------------
| 1. JALUR KHUSUS GUEST (Hanya Bisa Diakses Jika BELUM Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    // Jalur Login
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'prosesLogin']);
    
    // Jalur Registrasi Akun Baru
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'prosesRegister']);
});

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
/*
|--------------------------------------------------------------------------
| 2. JALUR TERPROTEKSI AUTH (Hanya Bisa Diakses Setelah SUKSES Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Jalur Keluar Sistem
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- Rute yang bisa diakses SEMUA ROLE (Admin, Dosen, Mahasiswa) ---
    Route::middleware(['role:admin,dosen,mahasiswa'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
        Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    });

    // --- Rute KHUSUS ADMIN & DOSEN ---
    Route::middleware(['role:admin,dosen'])->group(function () {
        Route::post('/ruangan/booking', [RuanganController::class, 'storeBooking'])->name('ruangan.booking');
    });

    // --- Rute SANGAT KHUSUS untuk ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
    Route::post('/jadwal/tambah', [JadwalController::class, 'store'])->name('jadwal.tambah');
    Route::post('/dosen/tambah', [DosenController::class, 'store'])->name('dosen.tambah');
    Route::post('/dosen/edit', [DosenController::class, 'update'])->name('dosen.edit');
    Route::post('/ruangan/booking/cancel', [RuanganController::class, 'cancelBooking'])->name('ruangan.cancel');
    Route::delete('/jadwal/hapus/{id}', [JadwalController::class, 'destroy'])->name('jadwal.hapus'); // ← pindahkan ke sini
});
    });

Route::get('/setup-dosen', function () {
    $daftarDosen = [
        "Prof. Dr. Zakarias Situmorang, MT",
        "Drs. Lamhot Sitorus, M.Kom",
        "Emerson P. Malau, S.Si, M.Kom",
        "Parasian D.P. Silitonga, S.Kom, M.Cs",
        "Andy Paul Harianja, ST. M Kom",
        "Wasit Ginting, S.Kom, M.Kom",
        "Sorang Pakpahan, S.Kom, M.Kom",
        "Desinta Purba, ST, M.Kom",
        "Masdiana Sagala, S.Kom, M.Kom",
        "Romanus Damanik, S.Kom, M.Kom",
        "Dr. Tonni Limbong, S.Kom, M.Kom",
        "Zekson Arizona Matondang, S.Kom, M.Kom",
        "Alex Rikki, S.Kom., M.Kom",
        "Sardo Sipayung, S.Kom., M.Kom",
        "Novri Siagian, S.Kom., M.Kom",
        "Anirma Ginting, S.Kom., M.Kom",
        "Paska Marto, S.Kom., M.Kom",
        "Pandi Barita Nauli Simangunsong, S. Kom, M.Kom",
        "Lotar Mateus Sinaga, M.Kom",
        "Ica Karina SH.,M.Hum",
        "Sahata Manalu, SH, M.Hum",
        "Rosa Maria Simamora, M.Hum",
        "Jontra Pangaribuan,S.Pd., M.Pd",
        "Swingly Purba, M.Sc",
        "Drs.Israel Sitepu, M.Si",
        "Elisabeth Simangunsong, SE,M.Si",
        "Dairi Simanjuntak, S.Pd, M.Pd",
        "P. Fiorensius Sipayung, OFM, Cap",
        "Pani Romauli Elisabet Naibaho,SE,M.Si",
        "Lamtiur Lidia Gultom, SE, M.Si",
        "Kolombus Siringo Ringo ST M Kom",
        "Saut M. Situmorang,ST,MT",
        "Dr. Dewi Sartika Br. Ginting Skom, Mkom",
        "Pastor Yosep",
        "Liana, S.Pd, M.Pd"
    ];

    foreach ($daftarDosen as $index => $nama) {
        $nidnDummy = '01' . str_pad($index + 1, 6, '0', STR_PAD_LEFT);
        
        \App\Models\Dosen::firstOrCreate(
            ['nama' => $nama],
            [
                'nidn' => $nidnDummy,
                'prodi' => 'Teknik Informatika', // Data dummy untuk prodi
                'status' => 'Aktif'              // Data dummy untuk status
            ]
        );
    }

    return "<h1 style='font-family: sans-serif; text-align: center; margin-top: 50px; color: #a50000;'>Mantap! 35 Data Dosen Berhasil Masuk ke Database!</h1>
            <p style='font-family: sans-serif; text-align: center;'>Silakan tutup halaman ini, kembali ke form jadwal Anda, dan refresh halamannya.</p>";
});