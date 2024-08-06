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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manpower_id');
            $table->string('nama_bank')->nullable();
            $table->unsignedBigInteger('no_rekening')->nullable();
            // $table->unsignedBigInteger('gaji_pokok')->nullable();
            $table->unsignedBigInteger('gaji_harian')->nullable();
            $table->unsignedBigInteger('gaji_lembur')->nullable();
            $table->unsignedBigInteger('jumlah_gaji_harian')->nullable();
            $table->unsignedBigInteger('jumlah_gaji_lembur')->nullable();
            $table->unsignedBigInteger('jumlah_gaji_bersih')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
