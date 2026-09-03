<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Idempotent seeder: hindari duplicate insert saat `migrate --seed` dijalankan berkali-kali
     User::factory()->create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password123'),
]);



        // Dummy awal untuk System Settings
        $this->call(\Database\Seeders\SettingsSeeder::class);
    }
}

