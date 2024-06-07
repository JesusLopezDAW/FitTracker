<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise_Log>
 */
class Exercise_LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Genera fechas aleatorias entre el 1 de enero de 2024 y la fecha y hora actual
        $startDate = strtotime('2024-01-01');
        $endDate = now()->timestamp;
        $randomDate = mt_rand($startDate, $endDate);

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'workout_id' => Workout::factory(), // Generar un workout usando el factory de Workout
            'exercise_id' => $this->faker->numberBetween(1, 100), // Generar un ejercicio usando el factory de Exercise
            'fecha_registro' => $this->faker->dateTimeBetween('-1 year', 'now'), // Assuming logs span the last year
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }
}
