<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // HAPUS truncate() biar aman
        // Partner::truncate();

        Partner::create([
            'partner_name' => 'PT. Paragon Technology',
            'logo_url' => 'partners/paragon.png' // Path relatif dari storage/app/public
        ]);

        Partner::create([
            'partner_name' => 'Kopi Kenangan',
            'logo_url' => 'partners/kopi-kenangan.png'
        ]);

        Partner::create([
            'partner_name' => 'Telkomsel',
            'logo_url' => 'partners/telkomsel.png'
        ]);

        Partner::create([
            'partner_name' => 'Pemko Medan',
            'logo_url' => 'partners/pemko-medan.png'
        ]);

        Partner::create([
            'partner_name' => 'Bank BRI',
            'logo_url' => 'partners/bri.png'
        ]);

        Partner::create([
            'partner_name' => 'Indomaret',
            'logo_url' => 'partners/indomaret.png'
        ]);
    }
}
