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
        Schema::create('manpowers', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('nama_pekerja');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_KTP')->nullable();
            $table->string('foto_KTP')->nullable();
            $table->string('mcu')->nullable();
            $table->string('kartu_induction')->nullable();
            $table->string('kartu_badge')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->string('skck')->nullable();
            $table->string('npwp')->nullable();
            $table->string('cv')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('paklaring')->nullable();
            $table->string('surat_vaksin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manpowers');
    }
};
