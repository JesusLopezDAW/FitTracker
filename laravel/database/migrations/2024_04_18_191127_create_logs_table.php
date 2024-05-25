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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("workout_id");
            $table->unsignedBigInteger("user_id");
            $table->date("start_date");
            $table->date("end_date");
            $table->string("duration");
            $table->integer("volume");
            $table->integer("records");
            $table->string("calories_burned");
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("workout_id")->references("id")->on("workouts")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
