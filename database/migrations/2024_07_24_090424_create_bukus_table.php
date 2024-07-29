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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_buku');
            $table->string('judul_buku');
            $table->text('daftar_isi')->nullable();
            $table->foreignId('kategori_id');
            $table->foreignId('pengarang_id');
            $table->foreignId('penerbit_id');
            $table->string('tahun_terbit');
            $table->integer('stok');
            $table->enum('status', ['Tersedia', 'Kosong', 'Diajukan']);
            $table->timestamps();
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
