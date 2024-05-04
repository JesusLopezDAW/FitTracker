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
            $table->unsignedBigInteger("user_id");
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
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
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
