<?php

namespace Database\Factories;

use App\Models\Follower;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follower::class;

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
            'user_id' => $this->faker->numberBetween(1, 500),
            'follower_user_id' => $this->faker->numberBetween(1, 500),
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }
}
