<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;

class JOCController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('service');

        // Filter berdasarkan kategori layanan
        if ($request->has('service_id') && $request->service_id != 'all') {
            $query->where('service_id', $request->service_id);
        }

        $products = $query->get();
        $services = Service::all();

        return view('admin.joc.index', compact('products', 'services'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Update margin saja
        $product->update([
            'profit_margin' => $request->profit_margin
        ]);

        return back()->with('success', "Margin untuk {$product->nama_produk} berhasil diubah!");
    }
}
