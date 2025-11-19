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
        Schema::create('jadwal_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')
                ->nullable()
                ->constrained('konsultasis')
                ->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('tipe_konsultasi', ['visit', 'online'])->nullable()->after('tanggal')->comment('Tipe konsultasi: visit (kunjungan lokasi) atau online');
            $table->string('jam', 5)->nullable()->after('tanggal')->comment('Time slot in HH:MM format (WIB)');
            $table->string('status', 30)->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_konsultasis');
    }
};
