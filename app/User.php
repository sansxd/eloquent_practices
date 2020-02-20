<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'level_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'created_at', 'email_verified_at'
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
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
    //el método se llama mutador
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
}
