<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\User;
use App\models\Post;
use App\models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->hasHero()->create();

        Post::factory(15)
          ->hasComments(rand(3,7))
          ->create();
    }
}
