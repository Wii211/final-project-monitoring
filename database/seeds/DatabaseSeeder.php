<?php

use RolesTableSeeder;
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
        $this->call(RolesTableSeeder::class);
        factory(App\User::class, 35)->create();
        factory(App\User::class, 70)->create();
    }
}
