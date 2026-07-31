<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('jabatan')->nullable()->after('prodi');
            $table->string('email')->nullable()->after('status');
            $table->string('phone')->nullable()->after('email');
            $table->string('foto')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn(['jabatan', 'email', 'phone', 'foto']);
        });
    }
};