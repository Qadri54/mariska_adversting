<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSecret;
use Illuminate\Support\Facades\Response;

class EncryptionController extends Controller
{
    // 1. Menampilkan Form
    public function showForm() {
        return view('form_enkripsi');
    }

    // 2. Proses Utama: Enkripsi & Simpan
    public function process(Request $request)
    {
        // Data yang mau dienkripsi
        $dataToEncrypt = [
            'name'    => $request->nama,
            'email'   => $request->email,
            'phone'   => $request->telepon,
            'address' => $request->alamat
        ];

        $key = "KunciRahasiaPolmed"; // Kunci rahasia (Max 16 char)
        $scriptPath = base_path('aes_encrypt.py'); // Lokasi script python

        $results = [];

        // LOOPING: Enkripsi setiap kolom satu per satu
        foreach ($dataToEncrypt as $field => $text) {
            // Perintah Terminal: python script.py "kunci" "teks"
            // escapeshellarg() dipakai biar aman dari hack
            $command = "python " . escapeshellarg($scriptPath) . " " . escapeshellarg($key) . " " . escapeshellarg($text);

            // Jalankan perintah dan tangkap outputnya
            $output = shell_exec($command);

            // Bersihkan spasi/enter
            $encryptedHex = trim($output);

            // Simpan ke array sementara
            // Nama kolom di DB adalah 'encrypted_' + nama field (misal: encrypted_name)
            $results['encrypted_' . $field] = $encryptedHex;
        }

        // Tambah waktu pembuatan
        $results['generated_at'] = now();

        // Simpan ke Database
        CustomerSecret::create($results);

        return back()->with('success', 'Sukses! Data terenkripsi dan tersimpan.');
    }

    // 3. Download Excel (CSV)
    public function downloadCsv()
    {
        $fileName = 'data_pelanggan_terenkripsi.csv';
        $data = CustomerSecret::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Enc_Nama', 'Enc_Email', 'Enc_Telp', 'Enc_Alamat', 'Waktu'];

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->encrypted_name,
                    $item->encrypted_email,
                    $item->encrypted_phone,
                    $item->encrypted_address,
                    $item->generated_at
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
