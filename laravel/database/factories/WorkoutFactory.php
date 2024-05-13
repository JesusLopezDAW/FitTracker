<?php 
namespace Database\Factories;

use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workout::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->sentence(10); // Generar una descripción aleatoria de hasta 10 palabras
        $description = substr($description, 0, 200); // Truncar la descripción a 200 caracteres si es necesario

        // Genera fechas aleatorias entre el 1 de enero de 2024 y la fecha y hora actual
        $startDate = strtotime('2024-01-01');
        $endDate = now()->timestamp;
        $randomDate = mt_rand($startDate, $endDate);

        return [
            'name' => $this->faker->sentence(),
            'description' => $description,
            'routine_id' => $this->faker->numberBetween(1, 1000), // IDs de 1 a 100
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }
}
