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
        Schema::create('jenis_biaya', function (Blueprint $table) {
            $table->id('id_jenisbiaya');
            $table->string('nama', 45);
            $table->integer('nominal');
            $table->enum('periode_pembayaran', ['bulanan', 'tahunan', 'sekali']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_biaya');
    }
};
