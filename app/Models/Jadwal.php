<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    // WAJIB: accessor (getXxxAttribute) tidak otomatis ikut ter-serialize ke JSON/array
    // kecuali didaftarkan di sini. Tanpa ini, @json($jadwal) di Blade tidak akan
    // menyertakan status/status_class — makanya kolom Status kosong di JS.
    protected $appends = ['status', 'status_class', 'nama_dosen'];

    // Tambahkan semua field yang dikirim dari form ke dalam $fillable
    protected $fillable = [
        'hari', 
        'jam', 
        'kode_jam', 
        'matakuliah', 
        'kelas', 
        'sks', 
        'dosen_id', // Atau 'id_dosen' (tergantung yang Anda gunakan dari error sebelumnya)
        'semester', 
        'ruang', 
        'jurusan'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id'); // Relasi ke model Dosen
    }

    // Accessor aman: pakai ini di Blade/JS ($jadwal->nama_dosen) alih-alih
    // $jadwal->dosen->nama langsung, supaya tidak crash kalau dosen_id
    // masih kosong (mis. jadwal baru yang dosennya belum dipilih/TBD).
    public function getNamaDosenAttribute()
    {
        return $this->dosen?->nama ?? 'Belum ditentukan';
    }

    // Helper: pecah string jam jadi [jam_mulai, jam_selesai] sebagai Carbon.
    // Mendukung format "10.40 - 13.10" maupun "10.40-13.10" (dengan/tanpa spasi).
    private function parseRentangJam()
    {
        if (empty($this->jam)) {
            return null;
        }

        $bersih = str_replace(' ', '', $this->jam); // "10.40-13.10"
        $parts = explode('-', $bersih);

        if (count($parts) !== 2 || trim($parts[0]) === '' || trim($parts[1]) === '') {
            return null;
        }

        try {
            return [
                Carbon::createFromTimeString(str_replace('.', ':', $parts[0])),
                Carbon::createFromTimeString(str_replace('.', ':', $parts[1])),
            ];
        } catch (\Exception $e) {
            return null;
        }
    }

    // Accessor untuk mendapatkan jam mulai sebagai objek Carbon
    public function getJamMulaiAttribute()
    {
        $rentang = $this->parseRentangJam();
        return $rentang[0] ?? null;
    }

    // Accessor untuk mendapatkan jam selesai sebagai objek Carbon
    public function getJamSelesaiAttribute()
    {
        $rentang = $this->parseRentangJam();
        return $rentang[1] ?? null;
    }

    // Accessor untuk mendapatkan status jadwal (string)
    public function getStatusAttribute()
    {
        $sekarang = Carbon::now('Asia/Jakarta');
        if (!$this->jam_mulai || !$this->jam_selesai) {
            return 'N/A';
        }
        if ($sekarang->between($this->jam_mulai, $this->jam_selesai)) {
            return 'Berlangsung';
        }
        if ($sekarang->greaterThan($this->jam_selesai)) {
            return 'Selesai';
        }
        return 'Akan Datang';
    }

    // Accessor untuk mendapatkan kelas CSS status
    public function getStatusClassAttribute()
    {
        switch ($this->status) {
            case 'Berlangsung':
                return 'success pulsing'; // hijau, sedang berjalan
            case 'Akan Datang':
                return 'blue-status'; // biru
            case 'Selesai':
                return 'gray-status'; // abu-abu, sudah selesai
            default:
                return 'gray-badge'; // N/A / tidak diketahui
        }
    }
}