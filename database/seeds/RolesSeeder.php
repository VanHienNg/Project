<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
        $author = Role::create([
            'name' => 'User', 
            'slug' => 'user',
            'permissions' => [
                'post.create' => true,
            ]
        ]);
        $editor = Role::create([
            'name' => 'Admin', 
            'slug' => 'admin',
            'permissions' => [
                'post.update' => true,
                'post.publish' => true,
            ]
        ]);
     }
}
