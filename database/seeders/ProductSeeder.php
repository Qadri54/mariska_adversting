<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================================
        // DEFINISI OPSI FINISHING
        // ==========================================================
        $finishingMMT = [
            ['nama' => 'Mata Ayam (Per Sudut)', 'harga' => 0],
            ['nama' => 'Selongsong (Kanan-Kiri)', 'harga' => 5000],
            ['nama' => 'Selongsong (Atas-Bawah)', 'harga' => 5000],
            ['nama' => 'Lipat Saja (Tanpa Lubang)', 'harga' => 0],
        ];

        $finishingSticker = [
            ['nama' => 'Tanpa Laminasi', 'harga' => 0],
            ['nama' => 'Laminasi Glossy (Kilap)', 'harga' => 15000],
            ['nama' => 'Laminasi Doff (Matte)', 'harga' => 15000],
            ['nama' => 'Cutting Pola (Kiss Cut)', 'harga' => 25000],
        ];

        $products = [
            // ==========================================
            // 1. ADVERTISING (Service ID: 3)
            // ==========================================
            [
                'service_id' => 3,
                'nama_produk' => 'Neon Box Backlite Grade C',
                'base_price' => 850000,
                'unit_type' => 'm2',
                'description' => "Spesifikasi:\n- Rangka Hollow 30\n- Lampu TL LED\n- Visual Flexy 440",
                'image_url' => 'products/neonbox.jpg', // ✅ FIXED: Tanpa 'images/'
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Neon Box Backlite Grade B',
                'base_price' => 1000000,
                'unit_type' => 'm2',
                'description' => "Spesifikasi:\n- Rangka Hollow 30\n- Lampu TL LED\n- Visual Backlite (Lebih Terang)",
                'image_url' => 'products/neonbox.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Neon Box Backlite Grade A',
                'base_price' => 1200000,
                'unit_type' => 'm2',
                'description' => "Spesifikasi:\n- Rangka Hollow 30\n- Lampu TL LED\n- Visual Backlite UV (Premium Quality)",
                'image_url' => 'products/neonbox.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Neon Box Akrilik',
                'base_price' => 1000000,
                'unit_type' => 'm2',
                'description' => "Spesifikasi:\n- Rangka Hollow 30\n- Lampu LED Strip\n- Visual Sticker Cutting",
                'image_url' => 'products/neonbox-akrilik.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Letter Timbul Akrilik',
                'base_price' => 15000,
                'unit_type' => 'cm',
                'description' => "Spesifikasi:\n- Acrylic 3mm\n- LED Strip\n- Adaptor",
                'image_url' => 'products/letter-akrilik.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Letter Timbul Stainless',
                'base_price' => 10000,
                'unit_type' => 'cm',
                'description' => "Material Stainless Steel (Anti Karat, Kilap/Doff).",
                'image_url' => 'products/letter-stainless.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Letter Timbul Galvanil',
                'base_price' => 10000,
                'unit_type' => 'cm',
                'description' => "Material Galvanil dengan Finishing Cat Duco (Warna Bebas).",
                'image_url' => 'products/letter-galvanil.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Tottem (Custom)',
                'base_price' => 0,
                'unit_type' => 'unit',
                'description' => "Pembuatan Tottem Sign Custom.",
                'image_url' => 'products/tottem.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Landmark (Custom)',
                'base_price' => 0,
                'unit_type' => 'unit',
                'description' => "Pembuatan Landmark / Signage Kota.",
                'image_url' => 'products/landmark.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 3,
                'nama_produk' => 'Facade (Custom)',
                'base_price' => 0,
                'unit_type' => 'unit',
                'description' => "Pelapis Fasad Gedung (ACP).",
                'image_url' => 'products/facade.jpg',
                'finishing_options' => null
            ],

            // ==========================================
            // 2. PERCETAKAN (Service ID: 2)
            // ==========================================
            [
                'service_id' => 2,
                'nama_produk' => 'MMT 280GSM',
                'base_price' => 18000,
                'unit_type' => 'm2',
                'description' => "Cetak Spanduk Outdoor (Frontlite) Ekonomis. Ketebalan 280gr.",
                'image_url' => 'products/mmt-280.jpg',
                'finishing_options' => $finishingMMT
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'MMT 340GSM',
                'base_price' => 25000,
                'unit_type' => 'm2',
                'description' => "Cetak Spanduk Outdoor (Frontlite) Standar. Ketebalan 340gr (Lebih tebal).",
                'image_url' => 'products/mmt-340.jpg',
                'finishing_options' => $finishingMMT
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'MMT 440GSM',
                'base_price' => 45000,
                'unit_type' => 'm2',
                'description' => "Cetak Spanduk Outdoor (Frontlite) Premium High Res. Ketebalan 440gr (Paling Tebal).",
                'image_url' => 'products/mmt-440.jpg',
                'finishing_options' => $finishingMMT
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'BACKLITE',
                'base_price' => 85000,
                'unit_type' => 'm2',
                'description' => "Bahan khusus Neon Box (tembus cahaya).",
                'image_url' => 'products/backlite.jpg',
                'finishing_options' => [['nama' => 'Lebihan Bahan', 'harga' => 0]]
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'BACKLITE UV',
                'base_price' => 120000,
                'unit_type' => 'm2',
                'description' => "Cetak Backlite menggunakan mesin UV.",
                'image_url' => 'products/backlite-uv.jpg',
                'finishing_options' => [['nama' => 'Lebihan Bahan', 'harga' => 0]]
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'ALBATROS',
                'base_price' => 85000,
                'unit_type' => 'm2',
                'description' => "Bahan kertas sintetis halus (semi-glossy) untuk indoor.",
                'image_url' => 'products/albatros.jpg',
                'finishing_options' => $finishingSticker
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'STICKER INDOOR',
                'base_price' => 85000,
                'unit_type' => 'm2',
                'description' => "Sticker Vinyl Indoor High Res.",
                'image_url' => 'products/sticker-indoor.jpg',
                'finishing_options' => $finishingSticker
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'STICKER OUTDOOR',
                'base_price' => 75000,
                'unit_type' => 'm2',
                'description' => "Sticker Vinyl Outdoor tahan air & panas.",
                'image_url' => 'products/sticker-outdoor.jpg',
                'finishing_options' => $finishingSticker
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'DURATRANS',
                'base_price' => 150000,
                'unit_type' => 'm2',
                'description' => "Backlit Film kualitas tinggi untuk Neon Box Indoor.",
                'image_url' => 'products/duratrans.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'STEMPEL OTOMATIS',
                'base_price' => 65000,
                'unit_type' => 'pcs',
                'description' => "Stempel Flash otomatis tanpa bantalan tinta.",
                'image_url' => 'products/stempel.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 2,
                'nama_produk' => 'PLAT BK (Plat Nomor)',
                'base_price' => 35000,
                'unit_type' => 'pcs',
                'description' => "Cetak Plat Nomor Kendaraan.",
                'image_url' => 'products/plat-bk.jpg',
                'finishing_options' => null
            ],

            // ==========================================
            // 3. EVENT ORGANIZER (Service ID: 1)
            // ==========================================
            [
                'service_id' => 1,
                'nama_produk' => 'Backdrop 2x2m',
                'base_price' => 2800000,
                'unit_type' => 'paket',
                'description' => "Backdrop + Rangka + Pasang Bongkar.",
                'image_url' => 'products/backdrop.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 1,
                'nama_produk' => 'Backdrop 3x3m',
                'base_price' => 3600000,
                'unit_type' => 'paket',
                'description' => "Backdrop + Rangka + Pasang Bongkar.",
                'image_url' => 'products/backdrop.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 1,
                'nama_produk' => 'Sewa Kursi Plastik',
                'base_price' => 3000,
                'unit_type' => 'unit',
                'description' => "Sewa Kursi Plastik Polos.",
                'image_url' => 'products/kursi-plastik.jpg',
                'finishing_options' => null
            ],
            [
                'service_id' => 1,
                'nama_produk' => 'Event Management',
                'base_price' => 500000,
                'unit_type' => 'person',
                'description' => "Jasa Handling Event.",
                'image_url' => 'products/eo.jpg',
                'finishing_options' => null
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['nama_produk' => $data['nama_produk']],
                $data
            );
        }

        $this->command->info('✅ Products seeded successfully!');
    }
}
