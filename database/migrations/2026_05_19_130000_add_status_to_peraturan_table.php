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
        Schema::table('peraturan', function (Blueprint $table) {
            $table->enum('status', ['publik', 'private'])->default('publik')->after('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peraturan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};