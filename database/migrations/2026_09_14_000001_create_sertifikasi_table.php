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
        if (!Schema::hasTable('sertifikasi')) {
            Schema::create('sertifikasi', function (Blueprint $table) {
                $table->id();
                $table->string('tahun');
                $table->string('nama');
                $table->string('kualifikasi');
                $table->string('klasifikasi');
                $table->date('waktu');
                $table->string('metode');
                $table->string('lokasi');
                $table->string('sumber_dana');
                $table->string('penanggung_jawab');
                $table->string('jenjang');
                $table->string('sub_klasifikasi');
                $table->string('jenjang_klasifikasi')->nullable();
                $table->string('jenjang_kualifikasi')->nullable();
                $table->string('nomor_sertifikat')->nullable();
                $table->date('selesai');
                $table->string('jam');
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasi');
    }
};
