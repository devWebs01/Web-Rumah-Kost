<?php

namespace Database\Factories;

use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['available', 'unavailable'];

        return [
            // boarding_house_id akan di‐assign di Seeder
            'boarding_house_id' => BoardingHouse::inRandomOrder()->first()->id ?? BoardingHouse::factory(),
            'room_number' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(500_000, 2_500_000),
            // Ukuran dalam format "3x4", "4x5", dll.
            'size' => $this->faker->numberBetween(2, 5).'x'.$this->faker->numberBetween(3, 6),
            // 'status' => $this->faker->randomElement($statuses),
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
