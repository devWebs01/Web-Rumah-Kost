<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'penyewa@testing.com',
            'role' => 'guest',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'pemilik@testing.com',
            'role' => 'owner',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@testing.com',
            'role' => 'admin',
        ]);

        // Jika Anda ingin membuat user, boarding house, dll. secara berurutan:
        $this->call([
            // UserSeeder::class, // (jika Anda punya seeder khusus untuk user)
            BoardingHouseSeeder::class,
        ]);
    }
}
