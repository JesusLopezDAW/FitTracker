<?php
namespace Database\Factories;

use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Log::class;

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
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'duration' => $this->faker->time(),
            'volume' => $this->faker->numberBetween(1, 8000),
            'records' => $this->faker->numberBetween(0, 5),
            'calories_burned' => $this->faker->randomFloat(2, 100, 1000),
            'workout_id' => $this->faker->unique()->numberBetween(1, 2000),
            'user_id' => $this->faker->numberBetween(1, 500),
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }
}