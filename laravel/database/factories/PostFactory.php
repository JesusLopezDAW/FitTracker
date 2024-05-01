<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 500),
            'workout_id' => $this->faker->numberBetween(1, 2000),
            'title' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
