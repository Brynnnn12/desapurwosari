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
        Schema::create('surat_pengantars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_layanan_id')->constrained()->onDelete('cascade');
            $table->string('nomor_surat')->unique();
            $table->enum('berkas_pendukung', ['KTP', 'KK', 'Surat Keterangan Lainnya']);
            $table->enum('status', ['proses', 'disetujui', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantars');
    }
};
