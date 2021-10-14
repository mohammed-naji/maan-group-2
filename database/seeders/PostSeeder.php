<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // foreach( range(1, 10) as $key) {
        //     Post::create([
        //         'title_en' => "Title $key",
        //         'title_ar' => "عنوان $key",
        //         'content_en' => "content $key",
        //         'content_ar' => "محتوى $key",
        //     ]);
        // }

        foreach( range(1, 10) as $key) {
            Post::create([
                'title' => json_encode(["en" => "Title $key", "ar" => "عنوان $key"]),
                'content' => json_encode(["en" => "content $key", "ar" => "محتوى $key"])
            ]);
        }
    }
}
