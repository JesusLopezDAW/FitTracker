<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Genera fechas aleatorias entre el 1 de enero de 2024 y la fecha y hora actual
        $startDate = strtotime('2024-01-01');
        $endDate = now()->timestamp;
        $randomDate = mt_rand($startDate, $endDate);

        // Ruta de la imagen en tu computadora
        $imagen = 'public/images/blank-profile-picture.png';

        // Leer el contenido de la imagen como datos binarios
        $datosImagen = file_get_contents($imagen);

        // Codificar los datos binarios en una cadena base64
        $imagenBase64 = base64_encode($datosImagen);

        // Crear el objeto BLOB
        $blob = "data:image/jpeg;base64," . $imagenBase64;

        return [
            'name' => fake()->name(),
            'surname' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'phone_number' => $this->faker->unique()->numerify('6########'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other', 'prefer_not_to_say']),
            'birthdate' => $this->faker->date(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'profile_photo_path' => $blob,
            'current_team_id' => null,
            'created_at' => date('Y-m-d H:i:s', $randomDate), // Establece 'created_at' en la fecha aleatoria generada
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
