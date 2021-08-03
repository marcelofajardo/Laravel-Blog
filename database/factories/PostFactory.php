<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Hero;

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
            'body' => $this->faker->paragraph(),
            'views_count' => $this->faker->randomDigit,
            'postable_id' => Hero::all()->random(),
            'postable_type' => Hero::class,
            'hero_id' => Hero::all()->random()
        ];
    }
}
