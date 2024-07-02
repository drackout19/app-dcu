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
        Schema::create('dcurecaps', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('manpower_id');
            $table->string('status_dcu')->nullable();
            $table->string('suhu_badan')->nullable();
            $table->string('kadar_oksigen')->nullable();
            $table->string('detak_jantung')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcurecaps');
    }
};
