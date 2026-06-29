<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Middleware: Customer harus login
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Tampilkan keranjang belanja
     * URL: /customer/cart
     */
    public function showCart(Request $request)
    {
        $cartItems = Session::get('cart', []);

        $totalHarga = 0;
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                if (isset($item['subtotal']) && is_numeric($item['subtotal'])) {
                    $totalHarga += $item['subtotal'];
                }
            }
        }

        return view('customer.cart.index', [
            'cartItems' => $cartItems,
            'totalHarga' => $totalHarga
        ]);
    }

    /**
     * Hapus item dari keranjang
     * URL: DELETE /customer/cart/{itemId}
     */
    public function removeFromCart(Request $request, $itemId)
    {
        $cart = Session::get('cart', []);

        // Filter cart berdasarkan ID item yang dipilih
        $remainingCart = array_filter($cart, function($item) use ($itemId) {
            return $item['id'] !== $itemId;
        });

        Session::put('cart', array_values($remainingCart));

        return redirect()->route('customer.cart.index')
                        ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Tampilkan history pesanan customer
     * URL: /customer/orders
     */
    public function index()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->id())
                       ->with('items')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Tampilkan form checkout (Create Order)
     * URL: /customer/orders/create
     */
    public function create(Request $request)
    {
        // Ambil selected items dari query string
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->route('customer.cart.index')
                           ->with('error', 'Pilih minimal 1 produk untuk checkout!');
        }

        // Ambil cart dari session
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('customer.cart.index')
                           ->with('error', 'Keranjang kosong!');
        }

        // Filter hanya item yang dipilih
        $cart = [];
        $total = 0;

        foreach ($cartItems as $item) {
            if (in_array($item['id'], $selectedItems)) {
                $cart[] = $item;
                $total += $item['subtotal'];
            }
        }

        if (empty($cart)) {
            return redirect()->route('customer.cart.index')
                           ->with('error', 'Item yang dipilih tidak valid!');
        }

        // Simpan ke session untuk backup
        session([
            'checkout_items' => $cart,
            'checkout_total' => $total
        ]);

        return view('customer.orders.create', compact('cart', 'total'));
    }


    /**
     * Simpan order baru (Checkout Submit)
     * URL: POST /customer/orders
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'items_json' => 'required|json'
        ]);

        try {
            $cart = json_decode($request->items_json, true);
            $totalPrice = 0;

            foreach ($cart as $item) {
                $totalPrice += $item['subtotal'];
            }

            // Buat order dengan status pending
            $order = Order::create([
                'customer_id' => Auth::guard('customer')->id(),
                'order_number' => 'ORD-' . date('YmdHis') . rand(1000, 9999),
                'order_date' => now(),
                'total_amount' => $totalPrice,
                'receiver_name' => $validated['receiver_name'],
                'receiver_phone' => $validated['receiver_phone'],
                'payment_proof_url' => null,
                'status' => 'Pending',
                'shipping_method' => 'pickup',
                'shipping_address' => 'Diskusi via WhatsApp / Ambil di Toko',
                'notes' => null
            ]);

            // DEBUG: cek apakah order berhasil dibuat
            if (!$order || !$order->order_id) {
                throw new \Exception('Order tidak berhasil dibuat atau ID kosong');
            }

            // Simpan detail items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['product_name'],
                    'quantity' => $item['area'] ?? 1,
                    'price' => $item['unit_price'] ?? 0,
                    'calculated_price' => $item['subtotal'],
                    'subtotal' => $item['subtotal'],
                    'specifications' => json_encode([
                        'length' => $item['length'] ?? null,
                        'width' => $item['width'] ?? null,
                        'material' => $item['material'] ?? null,
                        'finishing' => $item['finishing'] ?? null,
                        'design_file' => $item['design_file'] ?? null
                    ]),
                    'custom_details' => json_encode([])
                ]);
            }

            // Clear session cart
            session()->forget(['cart', 'checkout_items', 'checkout_total']);

            return redirect()->route('customer.orders.show', $order->order_id)
                           ->with('success', 'Pesanan berhasil dibuat! Silakan lanjutkan pembayaran.');

        } catch (\Exception $e) {
            \Log::error('Order creation error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Batalkan order
     * URL: POST /customer/orders/{id}/cancel
     */
    public function cancel($id)
    {
        $order = Order::where('customer_id', Auth::guard('customer')->id())
                     ->findOrFail($id);

        // Hanya bisa cancel jika status pending
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order ini tidak bisa dibatalkan!');
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Order berhasil dibatalkan.');
    }

    public function show($id)
    {
        // Pastikan order yang diambil hanya milik customer yang sedang login
        $order = Order::with(['items.product.service', 'customer'])
                      // Ambil data customer saat ini
                      ->where('customer_id', Auth::guard('customer')->id())
                      ->findOrFail($id); // Jika tidak ketemu, return 404

        // Tampilkan view detail
        return view('customer.orders.show', compact('order'));
    }

    public function uploadPayment(Request $request, $id)
{
    // Pastikan order yang diambil hanya milik customer yang sedang login
    $order = Order::where('customer_id', Auth::guard('customer')->id())
                 ->findOrFail($id);
    
    // Tentukan apakah ini upload pertama atau ulang (untuk notifikasi)
    // Jika payment_proof_url sudah ada nilainya, berarti ini adalah upload ulang
    $isFirstUpload = is_null($order->payment_proof_url); 

    // Validasi status
    if (!in_array($order->status, ['Pending', 'Cancelled', 'Rejected'])) {
        return back()->with('error', 'Order ini tidak bisa diupload ulang bukti pembayaran! Status saat ini: ' . $order->status);
    }

    // 1. Validasi File
    $validated = $request->validate([
        'payment_proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // MAX 5MB
    ]);

    // 2. Hapus bukti lama (jika ada) HANYA JIKA INI UPLOAD ULANG
    if (!$isFirstUpload && Storage::disk('public')->exists($order->payment_proof_url)) {
        Storage::disk('public')->delete($order->payment_proof_url);
    }

    // 3. Upload bukti baru
    $paymentProof = $request->file('payment_proof');
    $proofName = 'payment-' . Auth::guard('customer')->id() . '-' . time() . '.' . $paymentProof->getClientOriginalExtension();

    $proofPath = $paymentProof->storeAs('payment_proofs', $proofName, 'public');

    // 4. Update order dengan path yang bersih dan status baru
    $order->update([
        'payment_proof_url' => $proofPath,
        'status' => 'Awaiting Approval', // Status yang benar setelah customer upload
    ]);

    // 5. Redirect dengan pesan sukses yang SPESIFIK
    if ($isFirstUpload) {
        $message = 'Bukti pembayaran berhasil diupload! Pesanan Anda menunggu verifikasi Admin.';
    } else {
        $message = 'Bukti pembayaran berhasil diupload ulang! Menunggu verifikasi Admin.';
    }

    return back()->with('success', $message);
}
}
