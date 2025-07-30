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
        Schema::create('pagu_spp', function (Blueprint $table) {
            $table->id('id_paguspp');
            $table->unsignedBigInteger('id_anggaran');
            $table->unsignedBigInteger('id_tahun_ajaran_kode_kegiatan');
            $table->foreign('id_anggaran')->references('id_anggaran')->on('data_anggaran')->onDelete('restrict');
            $table->foreign('id_tahun_ajaran_kode_kegiatan') ->references('id_tahun_ajaran_kode_kegiatan')->on('tahun_ajaran_kode_kegiatan')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagu_spp');
    }
};
