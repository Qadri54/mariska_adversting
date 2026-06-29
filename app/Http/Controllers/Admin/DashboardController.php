<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SphHeader;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK KARTU
        $totalOrders = Order::count();
        
        // Menggunakan metode terpusat dari Model Order
        $ordersNeedingAttention = Order::whereIn('status', Order::getStatusProses())->count();

        // Pendapatan Bulan Ini
        $monthlyRevenue = Order::whereRaw('LOWER(status) = ?', ['completed'])
                               ->whereYear('order_date', Carbon::now()->year)
                               ->whereMonth('order_date', Carbon::now()->month)
                               ->select(DB::raw('COALESCE(SUM(total_amount), 0) as total'))
                               ->value('total');

        // Total Pendapatan Keseluruhan
        $totalRevenue = Order::whereRaw('LOWER(status) = ?', ['completed'])
                             ->select(DB::raw('COALESCE(SUM(total_amount), 0) as total'))
                             ->value('total');

        $totalCustomers = Customer::count();

        // 2. DATA TABEL & AKTIVITAS
        $recentOrders = Order::with('customer')
                             ->orderBy('order_date', 'desc')
                             ->limit(5)
                             ->get();

        $recentSPH = SphHeader::with('user')->orderBy('created_at', 'desc')->limit(3)->get()
            ->map(fn($sph) => ['description' => "SPH #{$sph->sph_number} dibuat", 'time' => $sph->created_at->diffForHumans()]);

        $recentVerified = Order::with('customer')->whereNotNull('verified_by')->orderBy('updated_at', 'desc')->limit(3)->get()
            ->map(fn($order) => ['description' => "Order {$order->customer->nama_lengkap} diverifikasi", 'time' => $order->updated_at->diffForHumans()]);

        $recentActivities = $recentSPH->concat($recentVerified)->sortByDesc('time')->take(5);

        // 3. CHART DATA
        $revenueChart = Order::whereRaw('LOWER(status) = ?', ['completed'])
                             ->select(DB::raw('MONTH(order_date) as month'), DB::raw('SUM(total_amount) as total'))
                             ->where('order_date', '>=', Carbon::now()->subMonths(6))
                             ->groupBy('month')->get();

        $chartLabels = []; $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->format('M');
            $match = $revenueChart->where('month', $date->month)->first();
            $chartData[] = $match ? round($match->total / 1000000, 2) : 0;
        }

        return view('admin.dashboard', compact(
            'totalOrders', 'ordersNeedingAttention', 'totalRevenue', 'monthlyRevenue',
            'totalCustomers', 'recentOrders', 'chartLabels', 'chartData', 'recentActivities'
        ));
    }
}