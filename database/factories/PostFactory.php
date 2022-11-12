<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->realText(30),
            'content' => fake()->realTextBetween(100, 250),
            'user_id' => User::get()->random()->id,
            'created_at' => '2022-11-06 16:25:55',
            'updated_at' => '2022-11-06 16:25:55',
            'category_id' => Category::get()->random()->id,
        ];
    }
}
