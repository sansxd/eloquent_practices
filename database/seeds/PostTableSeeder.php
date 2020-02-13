<?php

use App\Comment;
use App\Image;
use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 40)->create()->each(function (Post $post) {
            $post->image()->save(factory(Image::class)->make());
            $post->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $post->comments()->save(factory(Comment::class)->make());
            }
        });
    }
    public function array($max)
    {
        $values = [];
        for ($i = 1; $i < $max; $i++) {
            $values[] = $i;
        }
        return $values;
    }
}
