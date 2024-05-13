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
        // Genera fechas aleatorias entre el 1 de enero de 2024 y la fecha y hora actual
        $startDate = strtotime('2024-01-01');
        $endDate = now()->timestamp;
        $randomDate = mt_rand($startDate, $endDate);

        return [
            'name' => $this->faker->sentence(),
            'type' => $this->faker->randomElement([
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
            'user_id' => $this->faker->numberBetween(1, 500),
            // Puedes ajustar la lógica para el campo user_id según tus necesidades
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }
}
