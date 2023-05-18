<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        User::factory(3)->create();
        Pemilih::factory(3)->create();
        Kandidat::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-progamming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();
    }
}
