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
        Schema::create('jenis_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('keterangan');
            $table->unsignedBigInteger('kategori_kas_id_kategorikas');
            $table->foreign('kategori_kas_id_kategorikas')->references('id_kategorikas')->on('kategori_kas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_transaksi');
    }
};
