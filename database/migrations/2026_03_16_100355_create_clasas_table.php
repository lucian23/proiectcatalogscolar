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
        Schema::create('clase', function (Blueprint $table) {
            $table->id();
            $table->string('nume'); // Ex: "A", "B", "C"
            $table->integer('an'); // Ex: 9, 10, 11, 12
            $table->string('profil')->nullable(); // Ex: "Real", "Uman", "Stiinte"
            $table->year('an_scolar'); // Ex: 2025
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase');
    }
};
