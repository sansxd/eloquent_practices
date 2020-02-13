<?php

use App\Image;
use App\Location;
use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //function ($user) {} <---- esto es una funcion anonima
        factory(User::class, 5)->create()->each(function (User $user) {
            $profile = $user->profile()->save(factory(Profile::class)->make());
            $profile->location()->save(factory(Location::class)->make());
            $user->groups()->attach($this->array(rand(1, 3)));
            $user->image()->save(factory(Image::class)->make([
                'url' => 'http://lorempixel.com/90/90'
            ]));
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
