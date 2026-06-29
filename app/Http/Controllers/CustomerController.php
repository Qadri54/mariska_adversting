<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process; // Opsi modern
use Symfony\Component\Process\Exception\ProcessFailedException;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_pelanggan' => 'required|string',
        ]);

        $plainName = $request->nama_pelanggan;

        // Kunci Rahasia (Harus 16 karakter atau nanti dipadding oleh Python)
        // Sebaiknya simpan ini di .env, tapi untuk demo kita taruh sini
        $secretKey = "KunciRahasiaPolmed";

        // 2. Panggil Script Python
        // Asumsi file python ada di base_path (root folder project)
        $scriptPath = base_path('aes_encrypt.py');

        // Perintah CLI: python path/to/script.py "kunci" "nama_pelanggan"
        // escapeshellarg() penting untuk keamanan agar tidak di-hack via terminal
        $command = "python3 " . escapeshellarg($scriptPath) . " " . escapeshellarg($secretKey) . " " . escapeshellarg($plainName);

        // Eksekusi
        $encryptedName = shell_exec($command);

        // Bersihkan output (kadang ada spasi kosong/newline)
        $encryptedName = trim($encryptedName);

        // Cek jika gagal
        if (empty($encryptedName) || $encryptedName == 'Error') {
            return back()->with('error', 'Gagal mengenkripsi data.');
        }

        // 3. Simpan ke Database
        // Pastikan model & tabel sudah siap. Contoh:
        // \App\Models\Customer::create([
        //     'name' => $encryptedName, // Simpan hasil enkripsinya (hex)
        //     'email' => $request->email,
        // ]);

        // Untuk Tes: Tampilkan dulu hasilnya
        return response()->json([
            'nama_asli' => $plainName,
            'nama_terenkripsi_aes_hex' => $encryptedName
        ]);
    }
}
