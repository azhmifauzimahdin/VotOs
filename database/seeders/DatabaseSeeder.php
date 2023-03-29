<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User::create([
        //     'name' => 'Azhmi Fauzi Mahdin',
        //     'email' => 'azhmifauzi11@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' => 'Doddy Ferdiansyah',
        //     'email' => 'doddy@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-progamming'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quos odit porro sequi eveniet distinctio voluptatum quisquam. Corrupti, reprehenderit dolor.',
        //     'body' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga possimus iste exercitationem neque porro corporis officiis explicabo nostrum quae eos atque autem sit deleniti perspiciatis, expedita, tenetur consequuntur dolores quas. Perferendis officia voluptatibus iusto, itaque possimus distinctio vero minus cupiditate quasi dignissimos nesciunt quae, dicta aspernatur natus eos sed hic neque commodi facere iste eveniet doloribus repudiandae inventore. Assumenda omnis quia sint, laudantium quasi deserunt iste aliquam iure facere hic ut voluptatibus molestias amet optio, repellat dolores in distinctio explicabo quo! Sunt eligendi at facere ut iste fuga porro ratione! Iusto adipisci, laboriosam voluptatum ullam architecto eius tempore neque? Perferendis.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quos odit porro sequi eveniet distinctio voluptatum quisquam. Corrupti, reprehenderit dolor.',
        //     'body' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga possimus iste exercitationem neque porro corporis officiis explicabo nostrum quae eos atque autem sit deleniti perspiciatis, expedita, tenetur consequuntur dolores quas. Perferendis officia voluptatibus iusto, itaque possimus distinctio vero minus cupiditate quasi dignissimos nesciunt quae, dicta aspernatur natus eos sed hic neque commodi facere iste eveniet doloribus repudiandae inventore. Assumenda omnis quia sint, laudantium quasi deserunt iste aliquam iure facere hic ut voluptatibus molestias amet optio, repellat dolores in distinctio explicabo quo! Sunt eligendi at facere ut iste fuga porro ratione! Iusto adipisci, laboriosam voluptatum ullam architecto eius tempore neque? Perferendis.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quos odit porro sequi eveniet distinctio voluptatum quisquam. Corrupti, reprehenderit dolor.',
        //     'body' => ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga possimus iste exercitationem neque porro corporis officiis explicabo nostrum quae eos atque autem sit deleniti perspiciatis, expedita, tenetur consequuntur dolores quas. Perferendis officia voluptatibus iusto, itaque possimus distinctio vero minus cupiditate quasi dignissimos nesciunt quae, dicta aspernatur natus eos sed hic neque commodi facere iste eveniet doloribus repudiandae inventore. Assumenda omnis quia sint, laudantium quasi deserunt iste aliquam iure facere hic ut voluptatibus molestias amet optio, repellat dolores in distinctio explicabo quo! Sunt eligendi at facere ut iste fuga porro ratione! Iusto adipisci, laboriosam voluptatum ullam architecto eius tempore neque? Perferendis.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
