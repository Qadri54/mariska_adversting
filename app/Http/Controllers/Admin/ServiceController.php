<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::withCount(['products', 'galleries'])
                          ->orderBy('service_id', 'asc')
                          ->get();
        
        return view('admin.services.index', compact('services'));
    }
    
    public function create()
    {
        return view('admin.services.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan',
            'deskripsi' => 'nullable|string|max:1000',
        ]);
        
        Service::create($validated);
        
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }
    
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255|unique:services,nama_layanan,' . $id . ',service_id',
            'deskripsi' => 'nullable|string|max:1000',
        ]);
        
        $service->update($validated);
        
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        $productsCount = $service->products()->count();
        $galleryCount = $service->galleries()->count();
        
        if ($productsCount > 0 || $galleryCount > 0) {
            return back()->with('error', "Tidak dapat menghapus layanan ini karena masih memiliki {$productsCount} produk dan {$galleryCount} galeri.");
        }
        
        $service->delete();
        
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}