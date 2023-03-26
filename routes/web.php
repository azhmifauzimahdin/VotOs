<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "name" => "Azhmi Fauzi Mahdin",
        "email" => "azhmifauzi11@gmail.com"
    ]);
});


Route::get('/about', function () {
    $blog_post = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Azhmi Fauzi Mahdin",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit voluptatum repudiandae sequi fuga at? Voluptatum ullam voluptates facilis iste, iusto, molestiae quis illo, adipisci rem impedit nostrum saepe hic? Deleniti!"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => 'judul-post-kedua',
            "author" => "Airlangga",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit voluptatum repudiandae sequi fuga at? Voluptatum ullam voluptates facilis iste, iusto, molestiae quis illo, adipisci rem impedit nostrum saepe hic? Deleniti!"
        ]
    ];
    return view('about', [
        "title" => "About",
        "posts" => $blog_post
    ]);
});

Route::get('about/{slug}', function ($slug) {
    $blog_post = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Azhmi Fauzi Mahdin",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit voluptatum repudiandae sequi fuga at? Voluptatum ullam voluptates facilis iste, iusto, molestiae quis illo, adipisci rem impedit nostrum saepe hic? Deleniti!"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => 'judul-post-kedua',
            "author" => "Airlangga",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Velit voluptatum repudiandae sequi fuga at? Voluptatum ullam voluptates facilis iste, iusto, molestiae quis illo, adipisci rem impedit nostrum saepe hic? Deleniti!"
        ]
    ];

    $new_post = [];
    foreach ($blog_post as $post) {
        if ($post["slug"] === $slug) {
            $new_post = $post;
        }
    }
    return view('post', [
        "title" => "Single Post",
        "post" => $new_post
    ]);
});
