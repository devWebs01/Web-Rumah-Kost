<?php

namespace Database\Factories;

use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sampleFacilities = [
            'Wi-Fi Gratis',
            'AC',
            'Kamar Mandi Dalam',
            'Dapur Bersama',
            'Laundry',
            'Parkir Motor',
            'Keamanan 24 Jam',
            'CCTV',
            'Air Panas',
            'TV Kabel',
            'Kulkas',
        ];

        return [
            // boarding_house_id akan di‐assign di Seeder
            'boarding_house_id' => BoardingHouse::inRandomOrder()->first()->id ?? BoardingHouse::factory(),
            'name'              => $this->faker->randomElement($sampleFacilities),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}
