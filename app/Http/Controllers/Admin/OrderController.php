<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer')->orderBy('order_date', 'desc');

        if ($request->filled('status') && $request->status !== 'all') {
            switch ($request->status) {
                case 'pending': $query->whereIn('status', ['Pending', 'Awaiting Approval']); break;
                case 'proses': $query->whereIn('status', Order::getStatusProses()); break;
                case 'selesai': $query->where('status', 'Completed'); break;
            }
        }

        if ($request->filled('date_filter')) {
            $query->whereDate('order_date', $request->date_filter);
        }

        $orders = $query->paginate(20)->appends($request->all());

        $statusCounts = [
            'all' => Order::count(),
            'pending' => Order::whereIn('status', ['Pending', 'Awaiting Approval'])->count(),
            'proses' => Order::whereIn('status', Order::getStatusProses())->count(),
            'selesai' => Order::where('status', 'Completed')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product.service', 'verifiedBy'])
                      ->where('order_id', $id)
                      ->firstOrFail();
        return view('admin.orders.show', compact('order'));
    }

    public function verify($id)
    {
        $order = Order::where('order_id', $id)->firstOrFail();
        $order->update(['status' => 'Verified', 'verified_by' => Auth::id()]);
        return back()->with('success', 'Pembayaran diverifikasi!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('order_id', $id)->firstOrFail();
        $validated = $request->validate(['status' => 'required']);
        $order->update(['status' => $validated['status']]);
        return back()->with('success', "Status diperbarui!");
    }

    // --- FUNGSI INI YANG TADI HILANG ---
    public function downloadPaymentProof($id)
    {
        $order = Order::where('order_id', $id)->firstOrFail();
        
        // Menggunakan accessor payment_proof_url dari model Order
        $proofFile = $order->payment_proof_url;

        if (empty($proofFile)) {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan.');
        }

        // Membersihkan path URL menjadi path file
        $path = str_replace(url('/'), '', $proofFile);
        $path = ltrim($path, '/');
        $path = str_replace('storage/', '', $path); // Menghapus folder storage agar sesuai dengan disk

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di sistem: ' . $path);
    }
}