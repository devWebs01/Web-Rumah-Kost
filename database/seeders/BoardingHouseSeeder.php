<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Facility;
use App\Models\Regulation;
use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;
use Exception;

class BoardingHouseSeeder extends Seeder
{
    public function run()
    {
        // 1. Pastikan ada beberapa User sebagai pemilik. Jika belum ada, buat 5 user.
        try {
            if (User::count() < 5) {
                User::factory()->count(5)->create();
                $this->command->info("✔️-5 User berhasil dibuat sebagai pemilik.");
            } else {
                $this->command->info("ℹ️ Sudah ada " . User::count() . " User, tidak perlu membuat baru.");
            }
        } catch (Exception $e) {
            $this->command->error("❌-Gagal membuat User: " . $e->getMessage());
        }

        // 2. Buat 10 BoardingHouse
        try {
            BoardingHouse::factory()
                ->count(10)
                ->create()
                ->each(function ($boardingHouse) {
                    $this->command->info("✔️-BoardingHouse dibuat: [ID={$boardingHouse->id}] {$boardingHouse->name}");

                    // 3. Buat 5–10 kamar untuk setiap boarding house
                    try {
                        $roomCount = rand(5, 10);
                        Room::factory()
                            ->count($roomCount)
                            ->create([
                                'boarding_house_id' => $boardingHouse->id,
                            ]);
                        $this->command->info("✔️-{$roomCount} Room berhasil dibuat untuk BoardingHouse ID={$boardingHouse->id}.");
                    } catch (Exception $e) {
                        $this->command->error("❌-Gagal membuat Room untuk BoardingHouse ID={$boardingHouse->id}: " . $e->getMessage());
                    }

                    // 4. Buat 3–6 fasilitas untuk setiap boarding house
                    try {
                        $facilityNames = [
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
                        shuffle($facilityNames);
                        $takeFacilities = array_slice($facilityNames, 0, rand(3, 6));
                        foreach ($takeFacilities as $name) {
                            Facility::factory()->create([
                                'boarding_house_id' => $boardingHouse->id,
                                'name' => $name,
                            ]);
                        }
                        $this->command->info("✔️-" . count($takeFacilities) . " Facility berhasil dibuat untuk BoardingHouse ID={$boardingHouse->id}.");
                    } catch (Exception $e) {
                        $this->command->error("❌-Gagal membuat Facility untuk BoardingHouse ID={$boardingHouse->id}: " . $e->getMessage());
                    }

                    // 5. Buat 3–7 aturan (regulations) untuk setiap boarding house
                    try {
                        $regulationSlugs = [
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
                        shuffle($regulationSlugs);
                        $takeRegulations = array_slice($regulationSlugs, 0, rand(3, 7));
                        foreach ($takeRegulations as $rule) {
                            Regulation::factory()->create([
                                'boarding_house_id' => $boardingHouse->id,
                                'rule' => $rule,
                            ]);
                        }
                        $this->command->info("✔️-" . count($takeRegulations) . " Regulation berhasil dibuat untuk BoardingHouse ID={$boardingHouse->id}.");
                    } catch (Exception $e) {
                        $this->command->error("❌-Gagal membuat Regulation untuk BoardingHouse ID={$boardingHouse->id}: " . $e->getMessage());
                    }

                    // 6. Tambahkan 4–6 foto gallery per boarding house
                    try {
                        $galleryCount = rand(4, 6);
                        Gallery::factory()
                            ->count($galleryCount)
                            ->create([
                                'boarding_house_id' => $boardingHouse->id
                            ]);
                        $this->command->info("✔️-{$galleryCount} Gallery berhasil dibuat untuk BoardingHouse ID={$boardingHouse->id}.");
                    } catch (Exception $e) {
                        $this->command->error("❌-Gagal membuat Gallery untuk BoardingHouse ID={$boardingHouse->id}: " . $e->getMessage());
                    }
                });
        } catch (Exception $e) {
            $this->command->error("❌-Gagal membuat BoardingHouse: " . $e->getMessage());
        }
    }
}
