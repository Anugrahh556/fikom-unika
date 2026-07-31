<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn('dosen_id');
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('dosen_id')
                ->nullable()
                ->after('sks')
                ->constrained('dosens')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['dosen_id']);
            $table->dropColumn('dosen_id');
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->integer('dosen_id')->nullable();
        });
    }
};