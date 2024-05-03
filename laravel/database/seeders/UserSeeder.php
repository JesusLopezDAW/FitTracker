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
        // Crear el usuario "Jesus"
        DB::table('users')->insert([
            'name' => 'Jesus',
            'email' => 'jesuslpzz123@gmail.com',
            'password' => Hash::make('jesuslpzz123@gmail.com'),
            'email_verified_at' => now(), // Establecer la fecha de verificación del correo electrónico como la fecha de hoy
            'rol' => 'admin',
            // Los otros campos se llenarán con valores predeterminados o nulos según la definición del esquema
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
