<?php

namespace Database\Factories;

use App\Models\BoardingHouse;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        // 1. Siapkan beberapa provider gambar sebagai fallback
        $seed = Str::random(8);
        $providers = [
            // Unsplash random interior via source.unsplash (public)
            "https://source.unsplash.com/random/640x480?interior,room&sig={$seed}",
            // Picsum dengan tema acak
            "https://picsum.photos/seed/{$seed}/640/480",
            // DummyImage sebagai fallback
            'https://dummyimage.com/640x480/cccccc/000000&text=No+Image',
        ];

        $imageContents = null;
        $usedUrl = null;

        // 2. Coba semua provider hingga berhasil unduh
        foreach ($providers as $url) {
            try {
                $response = Http::timeout(5)->get($url);
                if ($response->ok()) {
                    $imageContents = $response->body();
                    $usedUrl = $url;
                    break;
                }
            } catch (\Exception $e) {
                // lanjut ke provider berikutnya
            }
        }

        // 3. Siapkan penyimpanan
        $filename = Str::random(12).'.jpg';
        $disk = Storage::disk('public');
        $dir = 'galleries';

        if (! $disk->exists($dir)) {
            $disk->makeDirectory($dir);
        }

        // 4. Simpan atau gunakan placeholder lokal
        if ($imageContents) {
            $disk->put("{$dir}/{$filename}", $imageContents);
            $imagePath = "{$dir}/{$filename}";
        } else {
            // Pastikan 'default.jpg' ada di storage/app/public/galleries/
            $imagePath = "{$dir}/default.jpg";
        }

        // 5. Pilih boarding_house_id acak atau buat baru
        $boardingHouseId = BoardingHouse::inRandomOrder()->first()->id
            ?? BoardingHouse::factory()->create()->id;

        return [
            'image' => $imagePath,
            'boarding_house_id' => $boardingHouseId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
