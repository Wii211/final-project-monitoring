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
        $this->call(RolesTableSeeder::class);
        factory(App\User::class, 35)->create();
        factory(App\RoleUser::class, 70)->create();
        factory(App\Lecturer::class, 15)->create();
        $this->call(PositionsTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        factory(App\LecturerTopic::class, 15)->create();
    }
}
