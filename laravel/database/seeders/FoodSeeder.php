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

        $imagen = 'public/images/logoFitTracker.png';
        $datosImagen = file_get_contents($imagen);
        $imagenBase64 = base64_encode($datosImagen);
        $blob = "data:image/jpeg;base64," . $imagenBase64;

        foreach ($data as $food) {
            // Genera una fecha aleatoria entre el 1 de enero de 2024 y hoy
            $randomTimestamp = rand(strtotime('2024-01-01'), time());
            $randomDate = date('Y-m-d H:i:s', $randomTimestamp);

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
                'created_at' => $randomDate, // Asigna la fecha aleatoria de creación
                // 'updated_at' => $randomDate, // Puedes asignar la misma fecha de creación a updated_at
            ]);
        }
    }
}
