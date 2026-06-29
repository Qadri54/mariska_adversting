<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use PDF; 
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan dan ringkasan data.
     */
    public function index(Request $request)
    {
        // 1. Tentukan Rentang Tanggal
        $startDate = $request->input('start_date') ?
                     Carbon::parse($request->input('start_date'))->startOfDay() :
                     Carbon::now()->subDays(30)->startOfDay();

        $endDate = $request->input('end_date') ?
                   Carbon::parse($request->input('end_date'))->endOfDay() :
                   Carbon::now()->endOfDay();

        // 2. Ambil Data Pesanan (Status: Verified ke atas)
        $orders = Order::with('customer')
                ->whereIn('status', ['Verified', 'Processing', 'Ready_for_pickup', 'Completed'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->get();

        // 3. Hitung Ringkasan
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_amount');

        $summary = [
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
        ];

        // 4. Kirim data ke View
        return view('admin.reports.index', compact('summary', 'orders'));
    }

    /**
     * Export Laporan ke PDF
     */
    public function exportPdf(Request $request)
    {
        // 1. Ambil Filter Tanggal (Sama seperti index)
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::now()->subDays(30)->startOfDay();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now()->endOfDay();

        // 2. Ambil Data
        $orders = Order::with('customer')
                ->whereIn('status', ['Verified', 'Processing', 'Ready_for_pickup', 'Completed'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'asc') // Urutkan dari lama ke baru untuk laporan
                ->get();

        $summary = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->sum('total_amount'),
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
        ];

        // 3. Generate PDF
        $pdf = PDF::loadView('admin.reports.pdf', compact('orders', 'summary'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Penjualan-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.pdf');
    }

    /**
     * Export Laporan ke Excel (CSV)
     */
public function exportExcel(Request $request)
{
    $startDate = $request->input('start_date', date('Y-m-01'));
    $endDate = $request->input('end_date', date('Y-m-d'));

    $orders = Order::with('customer')
        ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
        ->get();

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Penjualan_" . date('Ymd') . ".xls");

    echo '
    <style>
        .header-title { font-size: 16px; font-weight: bold; color: #000; }
        .sub-title { font-size: 14px; font-weight: bold; }
        .table-header { background-color: #fce4d6; font-weight: bold; text-align: center; border: 1px solid #000; }
        .data-row { border: 1px solid #000; }
    </style>
    <table>
        <tr><td colspan="6" class="header-title">CV ARYA ADVERTISING</td></tr>
        <tr><td colspan="6" class="sub-title">LAPORAN PENJUALAN</td></tr>
        <tr><td colspan="6">Periode: ' . date('d/m/Y', strtotime($startDate)) . ' s/d ' . date('d/m/Y', strtotime($endDate)) . '</td></tr>
        <tr><td></td></tr>
        <tr class="table-header">
            <th>NO</th>
            <th>TANGGAL</th>
            <th>ID PESANAN</th>
            <th>CUSTOMER</th>
            <th>STATUS</th>
            <th>TOTAL BAYAR</th>
        </tr>';

    $total = 0;
    foreach ($orders as $index => $order) {
        echo '<tr class="data-row">
            <td align="center">' . ($index + 1) . '</td>
            <td align="center">' . $order->created_at->format('d/m/Y') . '</td>
            <td>#' . $order->order_id . '</td>
            <td>' . ($order->customer->nama_lengkap ?? 'Guest') . '</td>
            <td>' . $order->status . '</td>
            <td align="right">' . $order->total_amount . '</td>
        </tr>';
        $total += $order->total_amount;
    }

    echo '<tr class="table-header">
            <td colspan="5" align="right">TOTAL PENDAPATAN</td>
            <td align="right">' . $total . '</td>
        </tr>
    </table>';
    exit;
}
}