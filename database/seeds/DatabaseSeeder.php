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
        $this->call(FinalStatusesTableSeeder::class);
        $this->call(DeadLineScheduleTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // factory(App\User::class, 35)->create();
        // factory(App\RoleUser::class, 70)->create();
        $this->call(PositionsTableSeeder::class);
        // factory(App\Lecturer::class, 15)->create();
        $this->call(TopicsTableSeeder::class);
        // factory(App\LecturerTopic::class, 15)->create();
        // factory(App\FinalStudent::class, 15)->create();
        // factory(App\RecomendationTitle::class, 25)->create();
        // factory(App\RecomendationTopic::class, 30)->create();
    }
}
