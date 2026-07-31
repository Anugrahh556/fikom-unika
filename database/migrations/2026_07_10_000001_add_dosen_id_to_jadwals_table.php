<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            // Hanya tambahkan dosen_id kalau kolomnya belum ada
            if (!Schema::hasColumn('jadwals', 'dosen_id')) {
                $table->foreignId('dosen_id')
                    ->nullable()
                    ->after('sks')
                    ->constrained('dosens')
                    ->nullOnDelete();
            }

            // Kolom 'dosen' (string) lama sudah tidak dipakai lagi,
            // karena Model Jadwal & Blade sekarang mengakses relasi $jadwal->dosen->nama.
            // Hanya hapus kalau kolomnya masih ada.
            if (Schema::hasColumn('jadwals', 'dosen')) {
                $table->dropColumn('dosen');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            if (Schema::hasColumn('jadwals', 'dosen_id')) {
                $table->dropForeign(['dosen_id']);
                $table->dropColumn('dosen_id');
            }
            if (!Schema::hasColumn('jadwals', 'dosen')) {
                $table->string('dosen')->nullable();
            }
        });
    }
};