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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->enum("visibility",["global", "user"]);
            $table->string("name");
            $table->enum('type', [
                'cardio',
                'olympic_weightlifting',
                'plyometrics',
                'powerlifting',
                'strength',
                'stretching',
                'strongman'
            ]);
            $table->enum('muscle', [
                'abdominals',
                'abductors',
                'adductors',
                'biceps',
                'calves',
                'chest',
                'forearms',
                'glutes',
                'hamstrings',
                'lats',
                'lower_back',
                'middle_back',
                'neck',
                'quadriceps',
                'traps',
                'triceps'
            ]);
            $table->string("equipment")->nullable();
            $table->enum('difficulty', [
                'beginner',
                'intermediate',
                'expert'
            ]);
            $table->longText("instructions")->nullable();
            $table->string("extra_info")->nullable();
            $table->longText("image")->nullable();
            $table->longText("image2")->nullable();
            $table->longText("video")->nullable();
            $table->enum('suggestion', [
                'yes',
                'no'
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
        Schema::dropIfExists('exercises');
    }
};
