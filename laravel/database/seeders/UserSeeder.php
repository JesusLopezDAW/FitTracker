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
        DB::table('users')->insert([
            'name' => 'FitTracker',
            'email' => 'fittrackerhq@gmail.com',
            'password' => Hash::make('fittrackerhq@gmail.com'),
            'email_verified_at' => now(), 
            'rol' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear el usuario "Jesus"
        DB::table('users')->insert([
            'name' => 'Jesus',
            'email' => 'jesuslpzz123@gmail.com',
            'password' => Hash::make('jesuslpzz123@gmail.com'),
            'email_verified_at' => now(), 
            'rol' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
