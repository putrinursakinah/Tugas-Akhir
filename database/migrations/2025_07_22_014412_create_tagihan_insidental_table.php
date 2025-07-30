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
        Schema::create('tagihan_insidental', function (Blueprint $table) {
            $table->id('id_insidental');
            $table->date('tanggal');
            $table->unsignedBigInteger('users_id_users');
            $table->foreign('users_id_users')->references('id_users')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_insidental');
    }
};
