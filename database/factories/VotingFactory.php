<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VotingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kandidat_id' => mt_rand(1, 4),
            'pemilih_id' => mt_rand(1, 4)
        ];
    }
}
