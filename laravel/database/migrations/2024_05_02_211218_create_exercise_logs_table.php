<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('exercise_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_id');
            $table->unsignedBigInteger('exercise_id');
            $table->enum('serie_type', ['warm_up', 'normal', 'failed', 'drop'])->default('normal');
            $table->integer('series');
            $table->integer('repeticiones');
            $table->integer('kilos');
            $table->timestamp('fecha_registro')->default(now());
            // Puedes agregar otros campos según tus necesidades
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_logs');
    }
};
