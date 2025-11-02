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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi_singkat');
            $table->string('url_gambar'); 
            $table->string('tipe'); 
            $table->date('tanggal_proyek'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};