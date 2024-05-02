<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'duration' => $this->faker->time(),
            'volume' => $this->faker->numberBetween(1, 8000),
            'records' => $this->faker->numberBetween(0, 5),
            'calories_burned' => $this->faker->randomFloat(2, 100, 1000),
            'workout_id' => $this->faker->numberBetween(1, 2000),
            'user_id' => $this->faker->numberBetween(1, 500)
        ];
    }
}