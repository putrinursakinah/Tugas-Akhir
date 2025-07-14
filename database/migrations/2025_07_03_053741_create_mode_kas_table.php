<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mode_kas', function (Blueprint $table) {
            $table->id('id_mode');
            $table->string('keterangan');
            $table->timestamps();
        });

         DB::table('mode_kas')->insert([
            ['keterangan' => 'Transaksi Tunai'],
            ['keterangan' => 'Transaksi Bank'],
            ['keterangan' => 'Penggeseran Uang (PU) Bank'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mode_kas');
    }
};
