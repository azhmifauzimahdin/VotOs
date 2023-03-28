<?php

namespace App\Models;

class Post
{
    private static $blog_post = [
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

    public static function all()
    {
        return collect(self::$blog_post);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
