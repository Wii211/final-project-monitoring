<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'user_name' => 'coordinator',
                    'email' =>  'coordinator@coordinator.com',
                    'phone_number' => '087817671153',
                    'gender' => 'Coordinator',
                    'image_profile' => null,
                    'password' => bcrypt('tiulmcoordinator'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'user_name' => 'admin',
                    'email' =>  'admin@admin.com',
                    'phone_number' => '08115169695',
                    'gender' => 'admin',
                    'image_profile' => null,
                    'password' => bcrypt('tiulmadmin'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

            $coordinator = User::whereUserName('coordinator')->first();

            $coordinator->roles()
                ->sync([Role::name('koordinator')->first()->id, Role::name('admin')->first()->id]);

            $admin = User::whereUserName('admin')->first();

            $admin->roles()->sync(Role::name('admin')->first()->id);
        }
    }
}
