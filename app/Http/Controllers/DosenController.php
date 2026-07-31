<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index() {
        // Ambil semua data dari database
        $dosens = Dosen::all();

        // --- LOGIKA NOTIFIKASI ---
        // Mengambil 5 aktivitas jadwal terbaru (baru dibuat atau diperbarui) dari 24 jam terakhir
        $jadwalTerbaru = Jadwal::where('updated_at', '>=', now()->subDay())
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('dosen', compact('dosens', 'jadwalTerbaru'));
    }

    // Fungsi AJAX untuk menyimpan dosen baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosens,nidn|max:20',
            'prodi' => 'required|string|max:100',
        ]);

        // Berikan nilai default jika form opsional dikosongkan
        $idBaru = Dosen::max('id') + 1;
        
        $dosen = Dosen::create([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'prodi' => $request->prodi,
            'jabatan' => $request->jabatan ?? 'Dosen Tetap',
            'status' => 'Aktif',
            'email' => $request->email ?? strtolower(str_replace(' ', '', $request->nama)) . '@unika.ac.id',
            'phone' => $request->phone ?? '+62 813-XXXX-XXXX',
            'foto' => 'https://i.pravatar.cc/150?img=' . ($idBaru % 70),
        ]);

        return response()->json(['success' => true, 'message' => 'Dosen berhasil ditambahkan!', 'data' => $dosen]);
    }

    // Fungsi AJAX untuk menyimpan hasil edit dosen
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn,' . $request->id,
            'prodi' => 'required|string|max:100',
            // Maksimal 2MB, cukup untuk foto profil dan aman untuk hosting gratis
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $dosen = Dosen::find($request->id);
        if (!$dosen) {
            return response()->json(['success' => false, 'message' => 'Data dosen tidak ditemukan!']);
        }

        $dataUpdate = [
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'prodi' => $request->prodi,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Hanya proses foto kalau admin memang upload file baru — kalau tidak,
        // foto lama dibiarkan tidak berubah sama sekali.
        if ($request->hasFile('foto')) {
            $fotoLama = $dosen->foto;

            $namaFile = 'dosen_' . $dosen->id . '_' . time() . '.' . $request->file('foto')->extension();
            // Disimpan langsung ke public/uploads/dosen (BUKAN storage/app/public),
            // supaya tidak butuh 'php artisan storage:link' — beberapa hosting
            // gratis tidak menyediakan akses terminal/artisan untuk itu.
            $request->file('foto')->move(public_path('uploads/dosen'), $namaFile);

            $dataUpdate['foto'] = asset('uploads/dosen/' . $namaFile);

            // Hapus file foto lama supaya folder upload tidak menumpuk —
            // tapi hanya kalau foto lama itu memang file lokal hasil upload
            // sebelumnya (bukan URL avatar bawaan/eksternal seperti pravatar).
            if ($fotoLama && str_starts_with($fotoLama, asset('uploads/dosen'))) {
                $pathLama = public_path('uploads/dosen/' . basename($fotoLama));
                if (file_exists($pathLama)) {
                    @unlink($pathLama);
                }
            }
        }

        $dosen->update($dataUpdate);

        return response()->json([
            'success' => true,
            'message' => 'Perubahan data dosen berhasil disimpan!',
            'data' => $dosen,
        ]);
    }
}