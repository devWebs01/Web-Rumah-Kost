<?php

namespace Database\Factories;

use App\Models\BoardingHouse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'guest')->inRandomOrder()->first()->id,
            'boarding_house_id' => BoardingHouse::where('verification_status', 'verified')->inRandomOrder()->first()->id,
            'body' => fake()->sentence(),
            'rating' => fake()->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
