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
        Schema::create('peraturan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('tahun');
            $table->string('judul');
            $table->string('file');
            $table->enum('kategori', [
                'UNDANG-UNDANG',
                'PERATURAN PEMERINTAH',
                'PERATURAN PRESIDEN',
                'PERATURAN MENTERI',
                'KEPUTUSAN MENTERI',
                'SURAT EDARAN MENTERI',
                'REFERENSI',
                'PERATURAN DAERAH',
                'PERATURAN GUBERNUR',
                'PERATURAN WALIKOTA',
                'SURAT KEPUTUSAN'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturan');
    }
};
