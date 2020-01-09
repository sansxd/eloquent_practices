<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    // If you want your pivot table to have automatically maintained
    // created_at and updated_at timestamps,
    // use the withTimestamps method on the relationship definition:
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
