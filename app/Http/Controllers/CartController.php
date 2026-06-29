<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    // Tambah ke keranjang
    public function addToCart(Request $request)
    {
        // Cek apakah sudah login
        if (!auth('customer')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Validasi input
        $request->validate([
            'product_id' => 'required|integer',
            'material' => 'required|string',
            'length' => 'required|numeric|min:0.1',
            'width' => 'required|numeric|min:0.1',
        ]);

        // Ambil data dari form
        $productId = $request->input('product_id');
        $material = $request->input('material');
        $length = (float) $request->input('length');
        $width = (float) $request->input('width');
        $finishing = $request->input('finishing', []);
        $designFile = $request->file('design_file');

        // Hitung area
        $area = $length * $width;

        // Ambil produk dari database
        $product = \App\Models\Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        // Parse material (format: "Nama_HargaModal")
        $materialParts = explode('_', $material);
        $materialName = $materialParts[0] ?? $material;
        $modalPrice = isset($materialParts[1]) ? (float) $materialParts[1] : $product->base_price;

        // Hitung harga jual (modal + margin 20%)
        $margin = $product->profit_margin ?? 20;
        $sellingPrice = $modalPrice + ($modalPrice * $margin / 100);

        // Hitung subtotal
        $subtotal = $area * $sellingPrice;

        // Hitung harga finishing
        $finishingTotal = 0;
        $finishingNames = [];
        if (!empty($finishing) && is_array($finishing)) {
            foreach ($finishing as $fin) {
                $finParts = explode('_', $fin);
                $finPrice = isset($finParts[1]) ? (float) $finParts[1] : 0;
                $finishingTotal += $finPrice;
                $finishingNames[] = $finParts[0] ?? $fin;
            }
        }

        $subtotal += $finishingTotal;

        // Upload file desain jika ada
        $filePath = null;
        if ($designFile && $designFile->isValid()) {
            // Upload file ke storage/app/public/designs
            $filePath = $designFile->store('designs', 'public');
        }

        // Buat item keranjang
        $cartItem = [
            'id' => uniqid(), // ID unik untuk item
            'product_id' => $productId,
            'product_name' => $product->nama_produk,
            
            // KUNCI PERBAIKAN: Menyimpan URL gambar yang sudah diproses oleh Accessor Model
            'image_url' => $product->image_url, 
            
            'material' => $materialName,
            'length' => $length,
            'width' => $width,
            'area' => $area,
            'unit_price' => $sellingPrice,
            'finishing' => implode(', ', $finishingNames),
            'finishing_price' => $finishingTotal,
            'design_file' => $filePath,
            'subtotal' => $subtotal,
            'timestamp' => time(),
        ];

        // Ambil cart dari session
        $cart = session('cart', []);
        $cart[] = $cartItem;

        // Simpan ke session
        session(['cart' => $cart]);

        return redirect()->route('customer.cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Lihat keranjang
    public function index()
    {
        $cartItems = session('cart', []);
        $total = collect($cartItems)->sum('subtotal');

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    // Hapus dari keranjang
    public function remove($id)
    {
        $cart = session('cart', []);
    
    // Konversi $id dari route menjadi string untuk perbandingan yang tepat
    $itemIdToRemove = (string)$id; 
    
    $remainingCart = array_filter($cart, function($item) use ($itemIdToRemove) {
        // Menggunakan perbandingan ketat (===) untuk memastikan item['id'] yang bertipe string dibandingkan dengan string
        return $item['id'] !== $itemIdToRemove; 
    });
    
    // Simpan kembali cart yang sudah difilter dan reset index array-nya
    session(['cart' => array_values($remainingCart)]);

    return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }

    // Clear semua keranjang
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }
}
