<?php

namespace Database\Factories;

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
        return [
            'workout_id' => $this->faker->numberBetween(1, 2000), // Assuming workouts range from 1 to 2000
            'exercise_id' => $this->faker->numberBetween(1, 160), // Assuming there are 100 exercises
            'serie_type' => $this->faker->randomElement(['warm_up', 'normal', 'failed', 'drop']),
            'series' => $this->faker->numberBetween(1, 5),
            'reps' => $this->faker->numberBetween(5, 15),
            'kilograms' => $this->faker->numberBetween(10, 100),
            'fecha_registro' => $this->faker->dateTimeBetween('-1 year', 'now'), // Assuming logs span the last year
        ];
    }
}
