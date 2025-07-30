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
        Schema::create('kode_kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('kode', 20)->unique();
            $table->string('kegiatan', 100);
            $table->string('kategori_kegiatan', 50);
            $table->unsignedBigInteger('kategori_id_kategori');
            $table->foreign('kategori_id_kategori')->references('id_kategori')->on('kategori');
            $table->unsignedBigInteger('id_tahun_ajaran_kode_kegiatan');
            $table->foreign('id_tahun_ajaran_kode_kegiatan')->references('id_tahun_ajaran_kode_kegiatan')->on('tahun_ajaran_kode_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_kegiatan');
    }
};
