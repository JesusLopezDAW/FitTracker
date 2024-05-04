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
            $table->string("equipment");
            $table->enum('difficulty', [
                'beginner',
                'intermediate',
                'expert'
            ]);
            $table->longText("instructions");
            $table->longText("image");
            $table->longText("image2");
            $table->longText("video");
            $table->timestamps();
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
