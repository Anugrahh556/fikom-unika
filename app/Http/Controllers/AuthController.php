<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahan untuk melakukan Query ke tabel Dosen/Mahasiswa
use Illuminate\Support\Facades\Password; // Untuk sistem lupa password bawaan Laravel
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin() {
        return view('auth.login'); 
    }

    // 2. Memproses verifikasi akun ke database MySQL Laragon
    public function prosesLogin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika sukses, langsung lempar ke halaman dashboard utama
            // Nanti di view/dashboard, Anda bisa mengatur tampilannya berdasarkan Auth::user()->role
            return redirect()->intended('/dashboard');
        }

        // Jika salah password/username, kembalikan ke form login
        return back()->withErrors([
            'loginError' => 'Username/NIDN/NIM atau Password yang Anda masukkan salah.',
        ]);
    }

    // 3. Menampilkan halaman form register
    public function showRegister() {
        return view('auth.register'); 
    }

    // 4. Memproses pendaftaran akun baru ke database MySQL DENGAN LOGIKA ROLE CERDAS
    public function prosesRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|unique:users,username|max:50', 
            'password' => 'required|string|min:5|confirmed', 
        ], [
            'username.unique' => 'NIDN/NIM ini sudah terdaftar di sistem! Silahkan langsung login.',
            'password.confirmed' => 'Konfirmasi password tidak cocok, silahkan periksa kembali.',
        ]);

        $nomorInduk = $request->username;
        // --- LOGIKA CERDAS PENENTUAN ROLE ---
        
        // 1. Cek apakah nomor induk (username) ini ada di tabel Dosen (kolom nidn)?
        $cekDosen = DB::table('dosens')->where('nidn', $nomorInduk)->exists();
        
        if ($cekDosen) {
            $role = 'dosen';
        } else {
            // 2. Jika bukan dosen, cek apakah ada di tabel Mahasiswa (kolom nim)?
            // (Pastikan di database Anda sudah ada tabel 'mahasiswas' ya)
            $cekMahasiswa = DB::table('mahasiswas')->where('nim', $nomorInduk)->exists();
            
            if ($cekMahasiswa) {
                $role = 'mahasiswa';
            } else {
                // 3. Jika tidak ada di kedua tabel, TOLAK PENDAFTARAN!
                return back()->withErrors([
                    'username' => 'Pendaftaran Ditolak: NIDN / NIM Anda tidak terdaftar di data Master Fakultas Ilmu Komputer.'
                ])->withInput();
            }
        }

        // --- AKHIR LOGIKA CERDAS ---

        // Masukkan data ke tabel Users MySQL
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username, // username ini berisi NIDN atau NIM
            'password' => Hash::make($request->password),
            'role' => $role, // Sistem otomatis menyuntikkan 'dosen' atau 'mahasiswa'
        ]);

        // --- HUBUNGKAN baris master data (dosens/mahasiswas) ke akun user baru ---
        // Tanpa ini, dashboard tidak akan pernah menemukan data mahasiswa/dosen
        // karena baris di tabel dosens/mahasiswas tidak pernah tahu user_id-nya.
        if ($role === 'dosen') {
            DB::table('dosens')->where('nidn', $nomorInduk)->update(['user_id' => $user->id]);
        } else {
            DB::table('mahasiswas')->where('nim', $nomorInduk)->update(['user_id' => $user->id]);
        }

        // Berikan pesan sukses yang dinamis sesuai rolenya
        return redirect('/')->with('successMessage', 'Akun berhasil didaftarkan sebagai ' . ucfirst($role) . '! Silahkan login.');
    }

    // 5. Mengeluarkan user dari sistem secara aman
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('successMessage', 'Anda berhasil logout dari sistem.');
    }

    // ======================================================
    // FITUR LUPA PASSWORD
    // ======================================================

    // 6. Menampilkan halaman "Lupa Password"
    public function showForgotPassword() {
        return view('auth.forgot-password');
    }

    // 7. Mencari akun berdasarkan Email ATAU NIDN/NIM, lalu kirim link reset
    //    ke EMAIL ASLI yang tersimpan di database (walau yang diketik user NIDN/NIM)
    public function sendResetLink(Request $request) {
        $request->validate([
            'identifier' => 'required|string',
        ], [
            'identifier.required' => 'Email atau NIDN/NIM wajib diisi.',
        ]);

        $user = User::where('email', $request->identifier)
                    ->orWhere('username', $request->identifier)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'identifier' => 'Akun dengan Email/NIDN/NIM tersebut tidak ditemukan di sistem.',
            ])->withInput();
        }

        // Laravel akan generate token, simpan ke tabel password_reset_tokens,
        // lalu kirim notifikasi (email) berisi link reset ke $user->email
        $status = Password::sendResetLink(['email' => $user->email]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('successMessage',
                'Link reset password sudah dikirim ke email terdaftar (' . $this->maskEmail($user->email) . '). '
                . 'Karena MAIL_MAILER masih "log", buka storage/logs/laravel.log untuk mengambil link-nya.'
            );
        }

        return back()->withErrors([
            'identifier' => 'Gagal mengirim link reset. Silahkan coba lagi beberapa saat.',
        ])->withInput();
    }

    // 8. Menampilkan form ganti password baru (dibuka dari link di email)
    public function showResetForm(Request $request, $token) {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // 9. Memproses password baru, simpan ke database
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok, silahkan periksa kembali.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/')->with('successMessage', 'Password berhasil diganti! Silahkan login dengan password baru Anda.');
        }

        // Token invalid / kadaluarsa / email tidak cocok
        return back()->withErrors(['email' => __($status)])->withInput($request->only('email'));
    }

    // Helper kecil: sensor sebagian email biar tidak bocor penuh di pesan sukses
    // Contoh: budi.santoso@gmail.com -> bu***********@gmail.com
    private function maskEmail($email) {
        [$name, $domain] = explode('@', $email);
        $visible = substr($name, 0, 2);
        return $visible . str_repeat('*', max(strlen($name) - 2, 1)) . '@' . $domain;
    }
}