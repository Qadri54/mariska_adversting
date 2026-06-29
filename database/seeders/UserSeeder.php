<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'nama_lengkap' => 'Admin Arya',
            'username' => 'adminarya',
            'password' => Hash::make('password123') // <-- Ganti 'password' dengan password aman
        ]);
    }
}
