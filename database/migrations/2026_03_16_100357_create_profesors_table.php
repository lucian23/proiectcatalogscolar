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
        Schema::create('profesori', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('prenume');
            $table->string('email')->unique();
            $table->string('telefon')->nullable();
            $table->string('grad_didactic')->nullable(); // Ex: "I", "II", "Definitivat"
            $table->boolean('activ')->default(true);
            $table->timestamps();
        });

        // Tabel pivot pentru relația many-to-many între profesori și materii
        Schema::create('materie_profesor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesor_id')->constrained('profesori')->onDelete('cascade');
            $table->foreignId('materie_id')->constrained('materii')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materie_profesor');
        Schema::dropIfExists('profesori');
    }
};
