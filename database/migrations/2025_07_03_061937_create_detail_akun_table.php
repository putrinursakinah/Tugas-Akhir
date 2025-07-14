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
        Schema::create('detail_akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->string('uraian');
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
        Schema::dropIfExists('detail_akun');
    }
};
