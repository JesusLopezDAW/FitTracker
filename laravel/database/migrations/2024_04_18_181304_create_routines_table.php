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
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum('type', [
                'cardio',
                'entrenamiento_de_fuerza',
                'HIIT',
                'yoga',
                'pilates',
                'flexibilidad',
                'calistenia',
                'kickboxing',
                'crossfit',
                'natación',
                'ciclismo',
                'correr',
                'escalada',
                'danza',
                'artes_marciales',
                'aeróbicos',
                'otros'
            ])->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
