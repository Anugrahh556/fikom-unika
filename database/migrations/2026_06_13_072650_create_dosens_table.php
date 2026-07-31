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
       Schema::create('dosens', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nidn')->unique(); // NIDN dosen dibuat unik agar tidak bentrok
        $table->string('prodi');
        $table->string('status')->default('Aktif'); // Otomatis bernilai 'Aktif' saat dosen ditambah
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
