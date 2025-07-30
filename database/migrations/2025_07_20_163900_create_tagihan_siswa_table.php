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
        Schema::create('tagihan_siswa', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->date('tgl_tagihan');
            $table->string('status', 45);
            $table->unsignedBigInteger('jenis_biaya_id_jenisbiaya');
            $table->unsignedBigInteger('kelas_has_siswa_id_kelashassiswa');
            $table->foreign('jenis_biaya_id_jenisbiaya')->references('id_jenisbiaya')->on('jenis_biaya');
            $table->foreign('kelas_has_siswa_id_kelashassiswa')->references('id_kelashassiswa')->on('kelas_has_siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_siswa');
    }
};
