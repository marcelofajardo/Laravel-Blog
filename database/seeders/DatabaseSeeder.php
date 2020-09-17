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
        User::factory(5)
          ->has(Post::factory()
            ->hasComments(rand(3,10))
            ->count(rand(3,5)))
          ->create();
    }
}
