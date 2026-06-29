<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat satu password hash untuk semua agar proses seeding lebih cepat
        $defaultPassword = Hash::make('password');

        $customers = [
            [
                'customer_id'  => 9,
                'email'        => 'mariskasiagian7@gmail.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'Mariska Siagian',
                'created_at'   => '2026-06-05 17:50:10',
                'updated_at'   => '2026-06-05 17:50:10',
            ],
            [
                'customer_id'  => 10,
                'email'        => 'gadaimas@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'GADAI MAS',
                'created_at'   => '2026-01-01 08:00:00',
                'updated_at'   => '2026-01-01 08:00:00',
            ],
            [
                'customer_id'  => 11,
                'email'        => 'umum@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'UMUM (Guest)',
                'created_at'   => '2026-01-01 08:00:00',
                'updated_at'   => '2026-01-01 08:00:00',
            ],
            [
                'customer_id'  => 12,
                'email'        => 'paragon@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'PARAGON',
                'created_at'   => '2026-01-01 08:00:00',
                'updated_at'   => '2026-01-01 08:00:00',
            ],
            [
                'customer_id'  => 13,
                'email'        => 'djarum@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'DJARUM',
                'created_at'   => '2026-01-01 08:00:00',
                'updated_at'   => '2026-01-01 08:00:00',
            ],
            [
                'customer_id'  => 14,
                'email'        => 'ikmas@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'IKMAS',
                'created_at'   => '2026-01-01 08:00:00',
                'updated_at'   => '2026-01-01 08:00:00',
            ],
            [
                'customer_id'  => 15,
                'email'        => 'indofood@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'INDOFOOD',
                'created_at'   => '2026-05-01 08:00:00',
                'updated_at'   => '2026-05-01 08:00:00',
            ],
            [
                'customer_id'  => 16,
                'email'        => 'assi@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'ASSI',
                'created_at'   => '2026-05-01 08:00:00',
                'updated_at'   => '2026-05-01 08:00:00',
            ],
            [
                'customer_id'  => 17,
                'email'        => 'adv@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'ADV',
                'created_at'   => '2026-05-01 08:00:00',
                'updated_at'   => '2026-05-01 08:00:00',
            ],
            [
                'customer_id'  => 20,
                'email'        => 'kormi@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'KORMI',
                'created_at'   => '2026-01-12 08:00:00',
                'updated_at'   => '2026-01-12 08:00:00',
            ],
            [
                'customer_id'  => 21,
                'email'        => 'varcos@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'VARCOS',
                'created_at'   => '2026-01-20 08:00:00',
                'updated_at'   => '2026-01-20 08:00:00',
            ],
            [
                'customer_id'  => 22,
                'email'        => 'pocari@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'POCARI',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 23,
                'email'        => 'arya@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'ARYA',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 24,
                'email'        => 'keind@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'KEIND',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 25,
                'email'        => 'jhsf@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'JHSF',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 26,
                'email'        => 'suntone@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'SUNTONE',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 27,
                'email'        => 'als@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'ALS',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ],
            [
                'customer_id'  => 28,
                'email'        => 'sulthon@example.com',
                'password'     => $defaultPassword,
                'nama_lengkap' => 'SULTHON',
                'created_at'   => '2026-02-01 08:00:00',
                'updated_at'   => '2026-02-01 08:00:00',
            ]
        ];

        Customer::insert($customers);
    }
}