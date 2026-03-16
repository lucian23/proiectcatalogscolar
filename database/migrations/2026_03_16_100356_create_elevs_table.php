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
        Schema::create('elevi', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('prenume');
            $table->string('email')->unique()->nullable();
            $table->string('telefon')->nullable();
            $table->date('data_nasterii')->nullable();
            $table->string('numar_matricol')->unique();
            $table->foreignId('clasa_id')->constrained('clase')->onDelete('cascade');
            $table->date('data_inscrierii')->default(now());
            $table->boolean('activ')->default(true);
            $table->text('observatii')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elevi');
    }
};
