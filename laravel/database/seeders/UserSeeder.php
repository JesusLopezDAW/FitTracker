<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear el usuario "FitTracker"
        // Ruta de la imagen en tu computadora
        $imagen = 'public/images/logoFitTracker.png';

        // Leer el contenido de la imagen como datos binarios
        $datosImagen = file_get_contents($imagen);

        // Codificar los datos binarios en una cadena base64
        $imagenBase64 = base64_encode($datosImagen);

        // Crear el objeto BLOB
        $blob = "data:image/jpeg;base64," . $imagenBase64;

        DB::table('users')->insert([
            'name' => 'FitTracker',
            'username' => 'FitTracker',
            'email' => 'fittrackerhq@gmail.com',
            'password' => Hash::make('fittrackerhq@gmail.com'),
            'email_verified_at' => now(), 
            'profile_photo_path' => $blob,
            'rol' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear el usuario "Jesus"
        // Ruta de la imagen en tu computadora
        $imagen2 = 'public/images/jesus.png';
        
        // Leer el contenido de la imagen como datos binarios
        $datosImagen2 = file_get_contents($imagen2);

        // Codificar los datos binarios en una cadena base64
        $imagenBase642 = base64_encode($datosImagen2);

        // Crear el objeto BLOB
        $blob2 = "data:image/jpeg;base64," . $imagenBase642;
        DB::table('users')->insert([
            'name' => 'Jesus',
            'username' => 'Jesus',
            'email' => 'jesuslpzz123@gmail.com',
            'password' => Hash::make('jesuslpzz123@gmail.com'),
            'email_verified_at' => now(), 
            'profile_photo_path' => $blob2,
            'rol' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
