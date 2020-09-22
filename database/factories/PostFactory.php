<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Hero;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => User::pluck('id')->random(),
            'title' => rtrim($this->faker->sentence(5,10),'.'),
            'body' => $this->faker->paragraph(),
            'views_count' => $this->faker->randomDigit,
            'postable_id' => Hero::pluck('id')->random(),
            'postable_type' => 'App\Models\Hero',

        ];
    }
}
