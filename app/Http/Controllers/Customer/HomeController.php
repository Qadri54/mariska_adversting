<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman homepage utama (Percetakan & Advertising)
     * URL: /
     */
    public function index()
    {
        // Kategori Homepage: 2 = Percetakan, 3 = Periklanan
        $homepageServiceIDs = [2, 3];

        $services = Service::withCount('products')->get();

        $galleries = Gallery::with('service')
                            ->whereIn('service_id', $homepageServiceIDs)
                            ->orderBy('gallery_id', 'desc')
                            ->limit(6)
                            ->get();

        $partners = Partner::orderBy('partner_id', 'asc')->get();

        $featuredProducts = Product::with('service')
                                   ->whereIn('service_id', $homepageServiceIDs)
                                   ->inRandomOrder()
                                   ->limit(6)
                                   ->get();

        try {
            $testimonials = \App\Models\Testimonial::latest()->get(); 
        } catch (\Exception $e) {
            $testimonials = collect(); // Kosongkan jika error (misal tabel belum ada)
        }
        
        return view('welcome', compact(
            'services',
            'galleries',
            'partners',
            'featuredProducts',
            'testimonials'
        ));
    }

    /**
     * Halaman List Produk & Layanan (Umum)
     */
    public function produkLayanan()
    {
        $services = Service::with('products')
                           ->whereIn('service_id', [2, 3]) 
                           ->get();

        return view('produk_layanan', compact('services'));
    }

    /**
     * Halaman Khusus Event Organizer (EO)
     * URL: /eo
     */
    public function showEOPage()
    {
        // 1. Cari ID Layanan yang berhubungan dengan EO
        // Menggunakan pencarian kata kunci agar dinamis
        $eoServiceIds = Service::where('nama_layanan', 'like', '%Event%')
                               ->orWhere('nama_layanan', 'like', '%Booth%')
                               ->orWhere('nama_layanan', 'like', '%Acara%')
                               ->orWhere('nama_layanan', 'like', '%Organizer%')
                               ->orWhere('nama_layanan', 'like', '%Sewa%') // Tambah 'Sewa'
                               ->pluck('service_id');

        // 2. Ambil Portfolio (Gallery) khusus EO
        $portfolioItems = Gallery::with('service')
                                 ->whereIn('service_id', $eoServiceIds)
                                 ->orderBy('created_at', 'desc')
                                 ->limit(6)
                                 ->get();

        // 3. Ambil PRODUK EO untuk KATALOG (Direct WA)
        // Tambahkan with('service') agar badge kategori di view tidak error/berat
        $eoProducts = Product::with('service')
                             ->whereIn('service_id', $eoServiceIds)
                             ->latest() // Produk terbaru di atas
                             ->get();

        // 4. Ambil Mitra
        $partners = Partner::orderBy('partner_id', 'asc')->get();
        
        // 5. Ambil Semua Layanan (Opsional, buat footer/menu)
        $services = Service::all(); 

        // 6. Kirim ke View 'eo'
        return view('eo', compact('services', 'portfolioItems', 'partners', 'eoProducts'));
    }
    
    public function about()
    {
        // Ambil data Mitra untuk slider
        $partners = Partner::orderBy('partner_id', 'asc')->get();

        // Kirim data ke view 'about'
        return view('about', compact('partners'));
    }
    
    public function portfolio()
{
    // Ambil semua galeri (atau dipaginate jika banyak)
    // Urutkan dari yang terbaru
    $galleries = Gallery::with('service')->orderBy('created_at', 'desc')->paginate(12);

    return view('portfolio', compact('galleries'));
}

}