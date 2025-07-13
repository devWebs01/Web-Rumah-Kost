<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Artisan::call('backup:run');
    }
}
