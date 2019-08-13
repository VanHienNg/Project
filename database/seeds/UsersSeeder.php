<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $admin = Role::where('slug', 'admin')->first();
        $user = Role::where('slug', 'user')->first();

        $user1 = User::create([
            'name' => 'user1', 
            'email' => 'pv1@allaravel.dev',
            'password' => bcrypt('123456')
        ]);
        $user1->roles()->attach($user);

        $user2 = User::create([
            'name' => 'user2', 
            'email' => 'pv2@allaravel.dev',
            'password' => bcrypt('123456')
        ]);
        $user2->roles()->attach($user);

        $user3 = User::create([
            'name' => 'admin', 
            'email' => 'btv1@allaravel.dev',
            'password' => bcrypt('123456')
        ]);
        $user2->roles()->attach($admin);
    }
}
