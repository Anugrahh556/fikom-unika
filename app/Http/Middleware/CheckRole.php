<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    // ...$roles berarti middleware ini bisa menerima banyak role sekaligus
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah role user ada di dalam daftar role yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, lempar pesan error 403 (Akses Ditolak)
        abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
    }
}