<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery; // <-- Jangan lupa import model Gallery

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel gallery dulu

        // Kita akan membuat 3 data dummy.
        // Asumsi dari ServiceSeeder:
        // ID 1 = Event Organizer
        // ID 2 = Percetakan
        // ID 3 = Periklanan

        Gallery::create([
            'service_id' => 1, // Milik Event Organizer
            'title' => 'Project EO - Acara Launching Produk',
            'image_url' => 'images/gallery/eo_launching.jpg',
            'description' => 'Sukses menggelar acara launching produk klien XYZ.'
        ]);

        Gallery::create([
            'service_id' => 2, // Milik Percetakan
            'title' => 'Cetak Ribuan Box Kemasan',
            'image_url' => 'images/gallery/cetak_box.jpg',
            'description' => 'Produksi box kemasan premium untuk brand lokal.'
        ]);

        Gallery::create([
            'service_id' => 3, // Milik Periklanan
            'title' => 'Pemasangan Neon Box Klien Kopi',
            'image_url' => 'images/gallery/neonbox_kopi.jpg',
            'description' => 'Instalasi neon box custom di 5 titik lokasi.'
        ]);
    }
}
