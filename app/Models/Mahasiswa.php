<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'jurusan',
        'kelas',
        'semester',
    ];

    // Relasi ke akun login (tabel users) — dipakai DashboardController untuk
    // mencari data mahasiswa berdasarkan user yang sedang login.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}