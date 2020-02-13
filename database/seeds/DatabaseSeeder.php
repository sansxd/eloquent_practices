<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GroupTableSeeder::class,
            LevelTableSeeder::class,
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            TagTableSeeder::class,
            PostTableSeeder::class,
            VideoTableSeeder::class
        ]);
    }
}
