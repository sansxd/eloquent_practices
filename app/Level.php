<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //un nivel tiene muchos usuarios
    public function users()
    {
        return $this->hasMany(Profile::class);
    }
    //1 nivel tiene muchos post atraves de usuario
    //con este metodo podemos ver rapidamente la cantidad de posts
    //y la lista de posts.
    //esto simplifica una query como: consultar a los usuarios, filtrarlos por un nivel
    //y con ello obtener sus posts.
    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
    public function videos()
    {
        return $this->hasManyThrough(Video::class, User::class);
    }
}
