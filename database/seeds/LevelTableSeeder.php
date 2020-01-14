<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Level::class)->create(['name' => 'Oro']);
        factory(Level::class)->create(['name' => 'Plata']);
        factory(Level::class)->create(['name' => 'Broncecito']);
    }
}
