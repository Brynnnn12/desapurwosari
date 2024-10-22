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
        Schema::table('users', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable(); // Menambahkan kolom tempat_lahir
            $table->date('tanggal_lahir')->nullable(); // Menambahkan kolom tanggal_lahir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'tanggal_lahir']); // Menghapus kolom jika migrasi dibatalkan
        });
    }
};
