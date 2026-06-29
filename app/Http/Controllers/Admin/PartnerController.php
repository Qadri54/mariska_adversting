<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Tampilkan daftar semua partner
     * URL: /admin/partners
     */
    public function index()
    {
        $partners = Partner::orderBy('partner_id', 'desc')->get();
        
        return view('admin.partners.index', compact('partners'));
    }
    
    /**
     * Tampilkan form tambah partner baru
     * URL: /admin/partners/create
     */
    public function create()
    {
        return view('admin.partners.create');
    }
    
    /**
     * Simpan partner baru
     * URL: POST /admin/partners
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048', // Max 2MB
        ]);
        
        // Upload logo
        $logo = $request->file('logo');
        $logoName = Str::slug($request->partner_name) . '-' . time() . '.' . $logo->getClientOriginalExtension();
        $logoPath = $logo->storeAs('partners', $logoName, 'public');
        
        Partner::create([
            'partner_name' => $request->partner_name,
            'logo_url' => $logoPath,
        ]);
        
        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan!');
    }
    
    /**
     * Tampilkan form edit partner
     * URL: /admin/partners/{id}/edit
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        
        return view('admin.partners.edit', compact('partner'));
    }
    
    /**
     * Update partner
     * URL: PUT /admin/partners/{id}
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);
        
        // Handle upload logo baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if (Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            
            $logo = $request->file('logo');
            $logoName = Str::slug($request->partner_name) . '-' . time() . '.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('partners', $logoName, 'public');
            
            $partner->logo_url = $logoPath;
        }
        
        $partner->update([
            'partner_name' => $request->partner_name,
        ]);
        
        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil diupdate!');
    }
    
    /**
     * Hapus partner
     * URL: DELETE /admin/partners/{id}
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        
        // Hapus file logo dari storage
        if (Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }
        
        $partner->delete();
        
        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus!');
    }
}