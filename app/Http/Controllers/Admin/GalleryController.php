<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Tampilkan daftar semua gallery
     * URL: /admin/gallery
     */
    public function index(Request $request)
    {
        $query = Gallery::with('service')->orderBy('gallery_id', 'desc');
        
        // Filter by service
        if ($request->has('service_id') && $request->service_id != 'all') {
            $query->where('service_id', $request->service_id);
        }
        
        $galleries = $query->paginate(24); // Grid 6x4
        $services = Service::all();
        
        return view('admin.gallery.index', compact('galleries', 'services'));
    }
    
    /**
     * Tampilkan form upload foto baru
     * URL: /admin/gallery/create
     */
    public function create()
    {
        $services = Service::all();
        
        return view('admin.gallery.create', compact('services'));
    }
    
    /**
     * Simpan foto baru
     * URL: POST /admin/gallery
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
        ]);
        
        // Upload gambar
        $image = $request->file('image');
        $imageName = Str::slug($request->title) . '-' . time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('gallery', $imageName, 'public');
        
        Gallery::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imagePath,
        ]);
        
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Foto gallery berhasil ditambahkan!');
    }
    
    /**
     * Tampilkan form edit gallery
     * URL: /admin/gallery/{id}/edit
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $services = Service::all();
        
        return view('admin.gallery.edit', compact('gallery', 'services'));
    }
    
    /**
     * Update gallery
     * URL: PUT /admin/gallery/{id}
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $validated = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        
        // Handle upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($gallery->image_url)) {
                Storage::disk('public')->delete($gallery->image_url);
            }
            
            $image = $request->file('image');
            $imageName = Str::slug($request->title) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('gallery', $imageName, 'public');
            
            $gallery->image_url = $imagePath;
        }
        
        $gallery->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil diupdate!');
    }
    
    /**
     * Hapus gallery
     * URL: DELETE /admin/gallery/{id}
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Hapus file gambar dari storage
        if (Storage::disk('public')->exists($gallery->image_url)) {
            Storage::disk('public')->delete($gallery->image_url);
        }
        
        $gallery->delete();
        
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil dihapus!');
    }
}