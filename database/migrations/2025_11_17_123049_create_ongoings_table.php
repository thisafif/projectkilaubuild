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
            $table->string('client_name');
            $table->enum('status', ['consultation', 'planning', 'in_progress', 'done'])->default('consultation');
            $table->integer('progress_percentage')->default(1);
            $table->json('images')->nullable();
            $table->json('location')->nullable();
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->date('expected_end_date');
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('pic_name');
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
