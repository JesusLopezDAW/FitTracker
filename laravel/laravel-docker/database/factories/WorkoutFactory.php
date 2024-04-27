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

        return [
            'name' => $this->faker->sentence(),
            'description' => $description,
            'routine_id' => $this->faker->numberBetween(1, 100), // IDs de 1 a 100
            'exercise_id' => $this->faker->numberBetween(1, 160), // IDs de 1 a 160
        ];
    }
}
