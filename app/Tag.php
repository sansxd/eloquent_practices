<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //1 etiqueta tiene muchos posts
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
