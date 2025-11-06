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
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('no_wa', 20);
            $table->string('provinsi', 100);
            $table->string('kabupatenkota', 100);
            $table->string('kecamatan', 100);
            $table->string('jenis_konsultasi', 100);
            $table->text('detil_konsultasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};
