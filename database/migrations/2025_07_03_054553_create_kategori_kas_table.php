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
        Schema::create('kategori_kas', function (Blueprint $table) {
            $table->id('id_kategorikas');
            $table->string('keterangan');
            $table->unsignedBigInteger('mode_kas_id_mode');
            $table->unsignedBigInteger('kategori_id_kategori');
            $table->foreign('mode_kas_id_mode')->references('id_mode')->on('mode_kas');
            $table->foreign('kategori_id_kategori')->references('id_kategori')->on('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kas');
    }
};
