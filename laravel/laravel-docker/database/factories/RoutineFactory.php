<?php

namespace Database\Factories;

use App\Models\Routine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoutineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Routine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'tipo' => $this->faker->randomElement([
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
            ]),
            'user_id' => $this->faker->numberBetween(1, 50),
            // Puedes ajustar la lógica para el campo user_id según tus necesidades
        ];
    }
}
