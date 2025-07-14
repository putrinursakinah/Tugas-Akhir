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
        Schema::create('kode_akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->string('kode', 20)->unique();
            $table->string('kegiatan');
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
        Schema::dropIfExists('kode_akun');
    }
};
