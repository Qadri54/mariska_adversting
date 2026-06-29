<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Product;

class ProductLayananController extends Controller
{
    /**
     * Tampilkan halaman kategori produk
     * URL: /produk_layanan
     */
            public function index()
            {
                // 1. Tentukan ID yang boleh tampil
                // (Sesuai database Anda, 2=Percetakan, 3=Periklanan)
                $allowed_ids = [2, 3];

                // 2. Ambil service HANYA JIKA ID-nya 2 ATAU 3
                $services = Service::with('products')
                                    ->whereIn('service_id', $allowed_ids)
                                    ->get();

                // 3. Kirim data yang sudah disaring ke view
                return view('produk_layanan', compact('services'));
            }

    /**
     * Tampilkan detail produk
     * URL: /produk/{id}
     */
    public function show($id)
    {
        $product = Product::with('service')->findOrFail($id);

        // --- LOGIKA IDENTIFIKASI KUSTOM (Business Logic) ---

        // 1. Definisikan ID Layanan yang memerlukan konsultasi (Event Organizer)
        $EVENT_ORGANIZER_ID = 1;

        // 2. Definisikan ID Produk kustom yang harus selalu via WA (CONTOH)
        // ANDA HARUS GANTI ANGKA-ANGKA INI DENGAN product_id YANG BENAR DARI DB ANDA.
        // Contoh: Facade, Landmark, Totem, dll.
        $CUSTOM_PRODUCT_IDS = [8,9,10];

        // 3. Logika Cek: Apakah ini EO ATAU Produk Kustom dari daftar ID?
        $isConsultationRequired =
            ($product->service_id == $EVENT_ORGANIZER_ID) ||
            (in_array($product->product_id, $CUSTOM_PRODUCT_IDS));

        // --- AKHIR LOGIKA IDENTIFIKASI KUSTOM ---

        // Kirimkan flag $isConsultationRequired ke view
        return view('produk.produk_detail', compact('product', 'isConsultationRequired'));
    }
    }

