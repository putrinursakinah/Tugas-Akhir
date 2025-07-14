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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal');
            $table->string('uraian');
            $table->integer('debet');
            $table->integer('kredit');
            $table->unsignedBigInteger('jenis_transaksi_id_transaksi');
            $table->unsignedBigInteger('detail_akun_id_akun');
            $table->unsignedBigInteger('data_anggaran_id');
            $table->foreign('jenis_transaksi_id_transaksi')->references('id_transaksi')->on('jenis_transaksi');
            $table->foreign('detail_akun_id_akun')->references('id_akun')->on('detail_akun');
            $table->foreign('data_anggaran_id')->references('id_anggaran')->on('data_anggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
