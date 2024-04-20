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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->unsignedBigInteger("routine_id");
            $table->foreign("routine_id")->references("id")->on("routines");
            $table->unsignedBigInteger("exercise_id");
            $table->foreign("exercise_id")->references("id")->on("exercises");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
