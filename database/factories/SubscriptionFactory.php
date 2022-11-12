<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $user_id = User::get()->random()->id;

        return [
            'user_id' => $user_id,
            'friend_id' => User::get()->except($user_id)->random()->id,
            'created_at' => '2022-11-06 16:25:55',
            'updated_at' => '2022-11-06 16:25:55',
        ];
    }
}
