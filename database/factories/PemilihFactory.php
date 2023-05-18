<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PemilihFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 3),
            'nisn' => $this->faker->nik(),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'kelas' => mt_rand(10, 12),
            'jk' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'username' => $this->faker->unique()->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'slug' => $this->faker->slug(),
        ];
    }
}
