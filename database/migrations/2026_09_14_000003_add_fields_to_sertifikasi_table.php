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
        Schema::table('sertifikasi', function (Blueprint $table) {
            $table->string('jenjang_klasifikasi')->nullable()->after('sub_klasifikasi');
            $table->string('jenjang_kualifikasi')->nullable()->after('jenjang_klasifikasi');
            $table->string('nomor_sertifikat')->nullable()->after('jenjang_kualifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikasi', function (Blueprint $table) {
            $table->dropColumn(['jenjang_klasifikasi', 'jenjang_kualifikasi', 'nomor_sertifikat']);
        });
    }
};
