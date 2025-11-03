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
            $table->string('jam', 5)->nullable()->after('tanggal')->comment('Time slot in HH:MM format (WIB)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_konsultasis', function (Blueprint $table) {
            $table->dropColumn('jam');
        });
    }
};
