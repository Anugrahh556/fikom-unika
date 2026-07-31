<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Semua field ini WAJIB ada di sini — kalau tidak, Dosen::create()/update()
    // akan MEMBUANG DIAM-DIAM field yang tidak terdaftar (tanpa error), padahal
    // DosenController mengirim semuanya (jabatan, email, phone, foto termasuk).
    protected $fillable = ['nama', 'nidn', 'prodi', 'status', 'jabatan', 'email', 'phone', 'foto'];
    // ... (Jika ada fungsi atau kode lain di bawahnya, biarkan saja)
}