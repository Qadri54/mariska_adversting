<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CalculatorController extends Controller
{
    /**
     * Tampilkan halaman kalkulator
     * URL: /calculator
     */
    public function index()
    {
        $services = Service::all();

        // Ambil cart dari session
        $cart = Session::get('cart', []);

        return view('customer.calculator.index', compact('services', 'cart'));
    }

    /**
     * Get products berdasarkan service (AJAX)
     * URL: /calculator/get-products/{service_id}
     */
    public function getProducts($serviceId)
    {
        $products = Product::where('service_id', $serviceId)
                          ->select('product_id', 'nama_produk', 'base_price', 'unit_type', 'image_url')
                          ->get();

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    /**
     * Hitung harga produk (AJAX)
     * URL: POST /calculator/calculate
     */
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Hitung harga dasar
        $basePrice = $product->base_price;
        $quantity = $request->quantity;
        $calculatedPrice = $basePrice * $quantity;

        // Tambahan biaya custom (jika ada)
        $additionalCost = 0;

        if ($request->has('custom_options')) {
            $customOptions = $request->custom_options;

            if (isset($customOptions['laminasi']) && $customOptions['laminasi'] == true) {
                $additionalCost += $calculatedPrice * 0.20;
            }

            if (isset($customOptions['finishing']) && $customOptions['finishing'] == 'glossy') {
                $additionalCost += $calculatedPrice * 0.15;
            }

            if (isset($customOptions['express']) && $customOptions['express'] == true) {
                $additionalCost += $calculatedPrice * 0.50;
            }
        }

        $finalPrice = $calculatedPrice + $additionalCost;

        return response()->json([
            'success' => true,
            'product' => [
                'nama_produk' => $product->nama_produk,
                'base_price' => number_format($basePrice, 0, ',', '.'),
                'unit_type' => $product->unit_type,
            ],
            'quantity' => $quantity,
            'calculated_price' => $calculatedPrice,
            'additional_cost' => $additionalCost,
            'final_price' => $finalPrice,
            'formatted_final_price' => 'Rp ' . number_format($finalPrice, 0, ',', '.'),
        ]);
    }

    /**
     * Tambahkan produk ke cart (DARI FORM KALKULATOR DI DETAIL PRODUK)
     * URL: POST /customer/calculator/add-to-cart
     */
    /**
     * Tambahkan produk ke cart (VERSI AMAN)
     */
    public function addToCart(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'length'     => 'required|numeric|min:0.1',
            'width'      => 'required|numeric|min:0.1',
            'material'   => 'required|string', // Nanti isinya cukup: 'flexi_china'
            'finishing'  => 'nullable|array',
            'design_file'=> 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'qty'        => 'required|numeric|min:1' // Jangan lupa validasi qty
        ]);

        // 2. DEFINISI HARGA DI SERVER (SUMBER KEBENARAN)
        // Ini mencegah user memanipulasi harga lewat Inspect Element
        $materialList = [
            'flexi_china'  => ['name' => 'Flexi China',  'price' => 25000],
            'flexi_korea'  => ['name' => 'Flexi Korea',  'price' => 35000],
            'flexi_german' => ['name' => 'Flexi German', 'price' => 45000],
        ];

        $finishingList = [
            'mata_ayam'  => ['name' => 'Mata Ayam',  'price' => 2000],
            'selongsong' => ['name' => 'Selongsong', 'price' => 5000],
        ];

        // 3. Ambil Data Produk
        $product = Product::findOrFail($request->product_id);

        // 4. Validasi Material yang dipilih
        // Kita bersihkan inputan user agar sesuai key di array (misal user kirim flexi_china_25000, kita ambil flexi_china nya saja)
        // TAPI saran saya ubah di VIEW value-nya jadi bersih.
        // Anggap input dari view sudah bersih: 'flexi_china'
        $selectedMaterialKey = $request->material;

        // Cek apakah material ada di daftar harga kita?
        if (!array_key_exists($selectedMaterialKey, $materialList)) {
            return response()->json(['success' => false, 'message' => 'Material tidak valid!'], 400);
        }

        $materialData = $materialList[$selectedMaterialKey];
        $materialPrice = $materialData['price'];
        $materialName  = $materialData['name'];

        // 5. Hitung Luas & Harga Dasar
        $length = $request->length;
        $width  = $request->width;
        $area   = $length * $width; // Luas dalam m2

        // Rumus: Luas x Harga Bahan
        $basePriceTotal = $area * $materialPrice;

        // 6. Hitung Finishing
        $finishingDetails = [];
        $finishingTotalCost = 0;

        if ($request->has('finishing') && is_array($request->finishing)) {
            foreach ($request->finishing as $finishingKey) {
                // Cek apakah finishing ada di daftar harga?
                if (array_key_exists($finishingKey, $finishingList)) {
                    $fData = $finishingList[$finishingKey];

                    $finishingDetails[] = [
                        'nama'  => $fData['name'],
                        'harga' => $fData['price']
                    ];
                    $finishingTotalCost += $fData['price'];
                }
            }
        }

        // 7. Hitung Total Akhir Satuan
        $pricePerItem = $basePriceTotal + $finishingTotalCost;

        // Total dikali Quantity
        $grandTotal = $pricePerItem * $request->qty;

        // 8. Upload File (Sama seperti kodemu)
        $designFilePath = null;
        if ($request->hasFile('design_file')) {
            $file = $request->file('design_file');
            $fileName = 'design-' . time() . '-' . $file->getClientOriginalName();
            $designFilePath = $file->storeAs('designs', $fileName, 'public');
        }

        // 9. Siapkan Data Cart
        $cart = Session::get('cart', []);
        $cartItemId = 'custom_' . time() . '_' . rand(1000, 9999);

        // Buat Breakdown (Rincian Harga untuk ditampilkan di Cart)
        $breakdown = [
            [
                'label' => "Bahan: {$materialName} ({$length}m x {$width}m)",
                'amount' => $basePriceTotal
            ]
        ];
        foreach ($finishingDetails as $fin) {
            $breakdown[] = [
                'label' => "+ Finishing: {$fin['nama']}",
                'amount' => $fin['harga']
            ];
        }

        // 10. Masukkan ke Array Cart
        $cart[$cartItemId] = [
            'product_id' => $product->product_id,
            'nama_produk' => $product->nama_produk,
            'image_url'   => $product->image_url ?? asset('images/default-product.png'),

            // Harga yang disimpan adalah hasil hitungan SERVER, bukan input user
            'price'       => $grandTotal,         // Harga Total (Satuan x Qty)
            'base_price'  => $pricePerItem,       // Harga Satuan (Base + Finishing)
            'quantity'    => $request->qty,
            'unit_type'   => 'm2',

            // Simpan detail lengkap
            'custom_details' => [
                'ukuran'      => "{$length}m x {$width}m",
                'luas'        => $area,
                'bahan'       => $materialName,
                'finishing'   => array_column($finishingDetails, 'nama'), // Ambil nama finishingnya aja
                'design_file' => $designFilePath,
                'breakdown'   => $breakdown
            ]
        ];

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil masuk keranjang!',
            'cart_count' => count($cart)
        ]);
    }
    /**
     * Hapus item dari cart
     * URL: DELETE /customer/calculator/cart/{itemId}
     */
    public function removeFromCart($itemId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang!',
                'cart_count' => count($cart),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item tidak ditemukan!',
        ], 404);
    }

    /**
     * Clear semua cart
     * URL: POST /customer/calculator/clear-cart
     */
    public function clearCart()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan!',
        ]);
    }
}
