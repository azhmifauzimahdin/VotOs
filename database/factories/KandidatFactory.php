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
            'nomor' => mt_rand(1, 100),
            'nama' => $this->faker->name(),
            'visi' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'misi' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'jk' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'slug' => $this->faker->slug()
        ];
    }
}
