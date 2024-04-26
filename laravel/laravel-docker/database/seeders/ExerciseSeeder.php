<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(base_path("database/json/exercises.json"));
        $data = json_decode($json);

        foreach ($data as $exercise) {
            DB::table('exercises')->insert([
                'name' => $exercise->name,
                'type' => $exercise->type,
                'muscle' => $exercise->muscle,
                'equipment' => $exercise->equipment,
                'difficulty' => $exercise->difficulty,
                'instructions' => $exercise->instructions,
                'image' => "",
                'video' => "",
            ]);
        }
    }
}
