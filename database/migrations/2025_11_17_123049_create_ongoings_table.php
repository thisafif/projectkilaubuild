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
        Schema::create('ongoings', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->enum('status', ['consultation', 'planning', 'in_progress', 'done'])->default('consultation')->nullable();
            $table->integer('progress_percentage')->default(1)->nullable();
            $table->json('images')->nullable();
            $table->json('location')->nullable();
            $table->longText('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('pic_name')->nullable();
            $table->string('pic_phone')->nullable();
            $table->text('vendors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongoings');
    }
};
