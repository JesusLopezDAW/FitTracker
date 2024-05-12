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

        $imagen = 'public/images/logoFitTracker.png';
        $datosImagen = file_get_contents($imagen);
        $imagenBase64 = base64_encode($datosImagen);
        $blob = "data:image/jpeg;base64," . $imagenBase64;

        foreach ($data as $exercise) {
            DB::table('exercises')->insert([
                'name' => $exercise->name,
                'user_id' => 1,
                'visibility' => 'global',
                'type' => $exercise->type,
                'muscle' => $exercise->muscle,
                'equipment' => $exercise->equipment,
                'difficulty' => $exercise->difficulty,
                'instructions' => $exercise->instructions,
                'extra_info' => "Creado desde el panel de administracion",
                'image' => $blob,
                'image2' => $blob,
                'video' => ""
            ]);
        }
    }
}
