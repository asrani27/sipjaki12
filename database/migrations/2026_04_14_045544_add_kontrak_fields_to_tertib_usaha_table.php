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
        Schema::table('tertib_usaha', function (Blueprint $table) {
            $table->bigInteger('nilai_kontrak')->nullable()->after('nama_paket');
            $table->string('lama_pekerjaan')->nullable()->after('nilai_kontrak');
            $table->date('tanggal_mulai_kontrak')->nullable()->after('lama_pekerjaan');
            $table->date('tanggal_berakhit_kontrak')->nullable()->after('tanggal_mulai_kontrak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tertib_usaha', function (Blueprint $table) {
            //
        });
    }
};
