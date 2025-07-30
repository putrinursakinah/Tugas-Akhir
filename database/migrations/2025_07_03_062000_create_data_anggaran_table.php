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
        Schema::create('data_anggaran', function (Blueprint $table) {
            $table->id('id_anggaran');
            $table->string('uraian');
            $table->integer('vol');
            $table->string('satuan', 20);
            $table->integer('harga_satuan');
            $table->string('jumlah');
            $table->string('pengeluaran')->default('0');
            $table->unsignedBigInteger('kode_kegiatan_id_kegiatan');
            $table->foreign('kode_kegiatan_id_kegiatan')->references('id_kegiatan')->on('kode_kegiatan');
            $table->unsignedBigInteger('komponen_id_komponen')->nullable();
            $table->foreign('komponen_id_komponen')->references('id_komponen')->on('komponen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_anggaran');
    }
};
