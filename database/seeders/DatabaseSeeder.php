<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Voting;
use App\Models\Pemilih;
use App\Models\Category;
use App\Models\Jabatan;
use App\Models\Kandidat;
use App\Models\Kelas;
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
        Kelas::factory(1)->create();
        Jabatan::factory(1)->create();
        User::factory(4)->create();
        Kandidat::factory(3)->create();
        Pemilih::factory(2)->create();
    }
}
