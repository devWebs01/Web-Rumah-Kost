<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardingHouse>
 */
class BoardingHouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Kategori dan status verifikasi yang mungkin
        $categories = ['male', 'female', 'mixed'];
        $statuses = ['pending', 'verified', 'rejected'];

        // 1. Dapatkan URL gambar acak (Picsum)
        //    Menggunakan seed acak agar tidak selalu sama
        $seed = Str::random(8);
        $url = "https://picsum.photos/seed/{$seed}/640/480";

        // 2. Unduh konten gambarnya
        try {
            $imageContents = file_get_contents($url);
        } catch (\Exception $e) {
            // Jika gagal, gunakan placeholder lokal (atau bisa pakai URL default)
            $imageContents = null;
        }

        // 3. Simpan ke disk public/thumbnails jika berhasil diunduh
        $filename = Str::random(12) . '.jpg';
        if ($imageContents) {
            Storage::disk('public')->put("thumbnails/{$filename}", $imageContents);
            $thumbnailPath = "thumbnails/{$filename}";
        } else {
            // Jika gagal unduh, gunakan placeholder
            // Pastikan file ini ada di public/storage/thumbnails/
            $thumbnailPath = "thumbnails/placeholder.jpg";
        }

        return [
            'name' => $this->faker->company . ' Kost',
            'location_map' => 'https://goo.gl/maps/' . $this->faker->regexify('[A-Za-z0-9]{8}'),
            'address' => $this->faker->address,
            // Pastikan ada user yang tersedia
            'owner_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'thumbnail' => $thumbnailPath,
            'category' => $this->faker->randomElement($categories),
            'verification_status' => $this->faker->randomElement($statuses),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
