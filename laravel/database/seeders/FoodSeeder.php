<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(base_path("database/json/food.json"));
        $data = json_decode($json);
        
        // Ruta de la imagen en tu computadora
        $imagen = 'public/images/logoFitTracker.png';

        // Leer el contenido de la imagen como datos binarios
        $datosImagen = file_get_contents($imagen);

        // Codificar los datos binarios en una cadena base64
        $imagenBase64 = base64_encode($datosImagen);

        // Crear el objeto BLOB
        $blob = "data:image/jpeg;base64," . $imagenBase64;

        foreach ($data as $food) {
            DB::table('food')->insert([
                'name' => $food->name,
                'user_id' => 1,
                'visibility' => 'global',
                'calories' => $food->calories,
                'size_portion_g' => $food->size_portion_g,
                'total_fat_g' => $food->total_fat_g,
                'saturated_fat_g' => $food->saturated_fat_g,
                'protein_g' => $food->protein_g,
                'sodium_mg' => $food->sodium_mg,
                'potassium_mg' => $food->potassium_mg,
                'carbohydrate_total_g' => $food->carbohydrate_total_g,
                'fiber_g' => $food->fiber_g,
                'sugar_g' => $food->sugar_g,
                'image' => $blob,
                'extra_info' => "Creado desde el panel de administracion",
            ]);
        }
    }
}
