<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Voting;
use App\Models\Pemilih;
use App\Models\Category;
use App\Models\Kandidat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        Pemilih::factory(15)->create();
        Kandidat::factory(15)->create();
        Voting::factory(15)->create();
    }
}
