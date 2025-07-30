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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->date('tgl_pembayaran');
            $table->unsignedBigInteger('tagihan_siswa_id_tagihan');
            $table->unsignedBigInteger('transaksi_id_transaksi');
            $table->foreign('tagihan_siswa_id_tagihan')->references('id_tagihan')->on('tagihan_siswa'); ;
            $table->foreign('transaksi_id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
