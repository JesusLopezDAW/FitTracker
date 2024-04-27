<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Routine;
use App\Models\Workout;
use Database\Factories\LogFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            ExerciseSeeder::class,
            FoodSeeder::class,
        ]);

        User::factory()->times(50)->create();
        Routine::factory()->count(200)->create();
        Workout::factory()->count(400)->create();
        // LogFactory::times(500)->create();

    }
}
