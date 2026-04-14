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
        Schema::create('tertib_usaha', function (Blueprint $table) {
            $table->id();
            $table->date('waktu_survey')->nullable();
            $table->string('nama_paket')->nullable();
            $table->string('no_nib')->nullable();
            $table->string('no_sbu')->nullable();
            $table->string('nama_badan_usaha')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('npwp')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('sifat_usaha')->nullable();
            $table->string('no_reg_sbu')->nullable();
            $table->date('masa_berlaku_sbu')->nullable();
            $table->string('klasifikasi_usaha')->nullable();
            $table->string('kualifikasi_usaha')->nullable();
            $table->string('layanan_usaha')->nullable();
            $table->string('url_file_nib')->nullable();
            $table->string('url_file_sbu')->nullable();
            $table->string('status_bpjs')->nullable();
            $table->string('url_kwitansi')->nullable();
            $table->string('instansi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tertib_usaha');
    }
};
