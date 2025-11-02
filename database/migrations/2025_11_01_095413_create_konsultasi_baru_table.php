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
        Schema::create('konsultasi_baru', function (Blueprint $table) {
            $table->id();
            
            // Kolom dari $data['...']
            $table->string('nama');
            $table->string('no_wa');
            $table->string('province_id'); // Menyimpan ID provinsi
            $table->string('regency_id');  // Menyimpan ID kabupaten
            $table->string('district_id'); // Menyimpan ID kecamatan
            $table->string('jenis');
            $table->text('detail')->nullable();
            $table->date('tanggal');

            $table->timestamps(); // Ini akan membuat created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi_baru');
    }
};