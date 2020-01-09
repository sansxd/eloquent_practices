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
}
