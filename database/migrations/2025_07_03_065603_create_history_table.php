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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->integer('revisi');
            $table->date('tanggal');
            $table->dateTime('waktu_pembuatan');
            $table->unsignedBigInteger('data_anggaran_id_anggaran');
            $table->foreign('data_anggaran_id_anggaran')->references('id_anggaran')->on('data_anggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
