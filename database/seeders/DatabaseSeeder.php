<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\User;
use App\models\Post;
use App\models\Comment;
use App\Models\Hero;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();

        Post::factory()
            ->count(rand(5,8))
            ->hasComments(rand(3, 7))
            ->create();
    }
}
