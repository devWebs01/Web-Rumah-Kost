<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\BoardingHouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Unsplash\HttpClient as UnsplashClient;
use Unsplash\Photo;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        // 1. Inisialisasi Unsplash Client (gunakan access key & secret dari .env)
        UnsplashClient::init([
            'applicationId' => env('UNSPLASH_ACCESS_KEY'),
            'secret' => env('UNSPLASH_SECRET_KEY', ''), // kosong jika hanya butuh akses publik
            'callbackUrl' => null,
            'utmSource' => env('APP_NAME', 'LaravelApp'),
        ]);

        // 2. Ambil satu foto acak dengan tema "interior room" (Ukuran 640x480)
        try {
            $photo = Photo::random([
                'query' => 'interior room',
                'w' => 640,
                'h' => 480,
            ]);
        } catch (\Exception $e) {
            $photo = null;
        }

        // 3. Jika berhasil mendapatkan Photo, ambil URL "regular" atau fallback ke link unduh
        if ($photo instanceof Photo) {
            $imageUrl = $photo->urls['regular'] ?? ($photo->links['download'] ?? null);
        } else {
            $imageUrl = null;
        }

        // 4. Unduh konten gambar dari Unsplash (atau DummyImage jika Unsplash gagal)
        $filename = Str::random(12) . '.jpg';

        if ($imageUrl) {
            try {
                $imageContents = @file_get_contents($imageUrl);
            } catch (\Exception $e) {
                $imageContents = null;
            }
        } else {
            $imageContents = null;
        }

        // 5. Jika Unduhan Unsplash gagal, gunakan DummyImage sebagai fallback
        if (empty($imageContents)) {
            $dummyUrl = "https://dummyimage.com/600x400/000/bfbfbf&text=no+image";
            try {
                $imageContents = @file_get_contents($dummyUrl);
            } catch (\Exception $e) {
                $imageContents = null;
            }
        }

        // 6. Simpan ke disk public/galleries atau fallback ke placeholder lokal
        if (!empty($imageContents)) {
            Storage::disk('public')->put("galleries/{$filename}", $imageContents);
            $imagePath = "galleries/{$filename}";
        } else {
            // Jika unduhan dummy juga gagal, gunakan placeholder lokal
            // (pastikan 'placeholder.jpg' sudah ada di storage/app/public/galleries/)
            $imagePath = "galleries/placeholder.jpg";
        }

        // 7. Tentukan boarding_house_id (ambil secara acak atau buat baru)
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
