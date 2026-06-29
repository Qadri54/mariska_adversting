<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada, agar tidak duplikat

        Service::create([
            'nama_layanan' => 'Event Organizer',
            'deskripsi' => 'Layanan Event Organizer profesional.'
        ]);

        Service::create([
            'nama_layanan' => 'Percetakan',
            'deskripsi' => 'Semua kebutuhan cetak Anda.'
        ]);

        Service::create([
            'nama_layanan' => 'Periklanan',
            'deskripsi' => 'Layanan periklanan indoor dan outdoor.'
        ]);
    }
}
