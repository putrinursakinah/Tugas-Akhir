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
            $table->string('kode', 20)->unique();
            $table->string('uraian');
            $table->integer('vol');
            $table->string('satuan', 20);
            $table->integer('harga_satuan');
            $table->string('jumlah');
            $table->string('pengeluaran');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('kode_akun_id_akun');
            $table->foreign('kode_akun_id_akun')->references('id_akun')->on('kode_akun');
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
