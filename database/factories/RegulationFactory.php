<?php

namespace Database\Factories;

use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regulation>
 */
class RegulationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sampleRules = [
            '5-orang-per-kamar',
            'maks-1-orang-per-kamar',
            'maks-2-orang-per-kamar',
            'maks-3-orang-per-kamar',
            'maks-4-orang-per-kamar',
            'akses-24-jam',
            'boleh-bawa-anak',
            'boleh-pasutri',
            'dilarang-merokok-di-kamar',
            'dilarang-bawa-hewan',
            'dilarang-menerima-tamu',
            'check-in-14-21',
            'check-out-maks-12',
            'tanpa-deposit',
            'termasuk-listrik',
            'khusus-mahasiswa',
            'khusus-karyawan',
            'swab-negatif-check-in',
            'pasutri-bawa-surat-nikah',
            'kriteria-umum',
            'wajib-ikut-piket',
        ];

        return [
            'boarding_house_id' => BoardingHouse::inRandomOrder()->first()->id ?? BoardingHouse::factory(),
            // Hilangkan unique() di randomElement
            'rule' => $this->faker->randomElement($sampleRules),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
