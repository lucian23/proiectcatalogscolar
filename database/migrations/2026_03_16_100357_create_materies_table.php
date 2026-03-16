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
        Schema::create('materii', function (Blueprint $table) {
            $table->id();
            $table->string('nume'); // Ex: "Matematică", "Română"
            $table->string('cod')->unique(); // Ex: "MAT", "ROM"
            $table->text('descriere')->nullable();
            $table->boolean('obligatorie')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materii');
    }
};
