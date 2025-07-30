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
        Schema::create('tagihan_tahunan', function (Blueprint $table) {
            $table->id('id_tahunan');
            $table->string('tahun', 45);
            $table->unsignedBigInteger('tagihan_siswa_id_tagihan');
            $table->unsignedBigInteger('users_id_users');
            $table->foreign('tagihan_siswa_id_tagihan')->references('id_tagihan')->on('tagihan_siswa')->onDelete('restrict');
            $table->foreign('users_id_users')->references('id_users')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_tahunan');
    }
};
