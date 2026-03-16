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
        Schema::create('note', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elev_id')->constrained('elevi')->onDelete('cascade');
            $table->foreignId('materie_id')->constrained('materii')->onDelete('cascade');
            $table->foreignId('profesor_id')->constrained('profesori')->onDelete('cascade');
            $table->decimal('nota', 3, 2); // Ex: 8.50, 9.75
            $table->string('tip')->default('curenta'); // Ex: "curenta", "teza", "recuperare"
            $table->date('data');
            $table->text('observatii')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note');
    }
};
