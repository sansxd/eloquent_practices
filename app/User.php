<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //un usuario tiene un solo perfil
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    //1 usuario pertenece a 1 nivel
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    //1 usuario pertenece a 1 grupo y tambien tiene muchos grupos
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
    //un usuario tiene una localizacion a traves de perfil.
    public function location()
    {
        return $this->hasOneThrough(Location::class, Profile::class);
    }
}
