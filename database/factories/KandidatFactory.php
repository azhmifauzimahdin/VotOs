<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kelas_id' => 1,
            'nomor' => mt_rand(1, 100),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jabatan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'visi' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'misi' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'slug' => $this->faker->slug()
        ];
    }
}
