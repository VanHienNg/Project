<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::where('name', 'user1')->first();
        $user2 = User::where('name', 'user2')->first();
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) { 
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title, 
                'body' => $faker->text($maxNbChars = 200),
                'slug' => str_slug($title),
                'published' => rand(0,1),
                'user_id' => $user1->id
            ]);
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title, 
                'body' => $faker->text($maxNbChars = 200),
                'slug' => str_slug($title),
                'published' => rand(0,1),
                'user_id' => $user2->id
            ]);
        }
    }
}
