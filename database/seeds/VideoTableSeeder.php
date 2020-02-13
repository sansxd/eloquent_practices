<?php

use App\Comment;
use App\Image;
use App\Video;
use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Video::class, 40)->create()->each(function (Video $video) {
            $video->image()->save(factory(Image::class)->make());
            $video->tags()->attach($this->array(rand(1, 12)));

            $number_comments = rand(1, 6);
            for ($i = 0; $i < $number_comments; $i++) {
                $video->comments()->save(factory(Comment::class)->make());
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
