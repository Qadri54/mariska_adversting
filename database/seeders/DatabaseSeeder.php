<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ServiceSeeder; // <-- PASTIKAN INI ADA
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang tidak punya dependensi dulu
        $this->call([
            // ServiceSeeder::class,
            // UserSeeder::class,
            CustomerSeeder::class,
            // OrderSeeder::class,
            // // OrderItemSeeder::class,
            // PartnerSeeder::class, // (Anda bisa buat isinya sendiri)
        ]);

        // // Panggil seeder yang tergantung pada ServiceSeeder
        // $this->call([
        //     ProductSeeder::class,
        //     GallerySeeder::class,
        //     OrderItemSeeder::class // (Anda bisa buat isinya sendiri)
        // ]);
    }
}
