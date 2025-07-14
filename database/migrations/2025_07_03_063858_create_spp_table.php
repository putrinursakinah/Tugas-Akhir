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
        Schema::create('spp', function (Blueprint $table) {
            $table->id('id_spp');
            $table->string('uraian');
            $table->unsignedBigInteger('kelas_id_kelas');
            $table->unsignedBigInteger('transaksi_id_transaksi');
            $table->foreign('kelas_id_kelas')->references('id_kelas')->on('kelas');
            $table->foreign('transaksi_id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp');
    }
};
