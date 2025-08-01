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
        Schema::create('kelas_has_siswa', function (Blueprint $table) {
            $table->id('id_kelashassiswa');
            $table->unsignedBigInteger('kelas_id_kelas');
            $table->unsignedBigInteger('siswa_id_siswa');
            $table->foreign('kelas_id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
            $table->foreign('siswa_id_siswa')->references('id_siswa')->on('siswa')->onDelete('restrict');
            $table->unique(['kelas_id_kelas', 'siswa_id_siswa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_has_siswa');
    }
};
