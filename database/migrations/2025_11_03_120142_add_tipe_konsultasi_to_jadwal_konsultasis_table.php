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
        Schema::table('jadwal_konsultasis', function (Blueprint $table) {
            $table->enum('tipe_konsultasi', ['visit', 'online'])->nullable()->after('tanggal')->comment('Tipe konsultasi: visit (kunjungan lokasi) atau online');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_konsultasis', function (Blueprint $table) {
            $table->dropColumn('tipe_konsultasi');
        });
    }
};
