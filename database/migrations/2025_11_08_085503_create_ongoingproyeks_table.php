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
        Schema::create('ongoingproyeks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('tipe', ['bangun_baru', 'renovasi', 'interior']);
            $table->text('deskripsi_singkat');
            $table->date('tanggal_proyek'); 
            $table->string('provinsi_proyek')->nullable();
            $table->string('attachmentproyek')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongoingproyeks');
    }
};
