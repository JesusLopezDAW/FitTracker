<?php

namespace Database\Seeders;

use App\Models\Exercise_log;
use App\Models\Routine;
use App\Models\User;
use App\Models\Workout;
use Database\Factories\CommentFactory;
use Database\Factories\Exercise_LogFactory;
use Database\Factories\FollowerFactory;
use Database\Factories\FollowingFactory;
use Database\Factories\LikeFactory;
use Database\Factories\PostFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory()->times(500)->create();
        Routine::factory()->count(1000)->create();
        Workout::factory()->count(2000)->create();
        PostFactory::times(2000)->create();
        LikeFactory::times(5000)->create();
        CommentFactory::times(5000)->create();
        FollowingFactory::times(1000)->create(); 
        FollowerFactory::times(1000)->create(); 
        Exercise_LogFactory::times(5000)->create(); 

    }
}
