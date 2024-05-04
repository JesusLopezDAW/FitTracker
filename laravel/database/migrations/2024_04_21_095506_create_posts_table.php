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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("workout_id");
            $table->string("title")->nullable();
            $table->longText("image")->nullable();
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
        Schema::dropIfExists('posts');
    }
};
