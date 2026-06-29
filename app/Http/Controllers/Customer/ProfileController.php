<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mengelola file
use App\Models\Customer;

class ProfileController extends Controller
{
    /**
     * Middleware: Customer harus login
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }
    
    /**
     * Tampilkan profil customer
     * URL: /customer/profile
     */
    public function show()
    {
        $customer = Auth::guard('customer')->user();
        
        return view('customer.profile.show', compact('customer'));
    }
    
    /**
     * Tampilkan form edit profil
     * URL: /customer/profile/edit
     */
    public function edit()
    {
        $customer = Auth::guard('customer')->user();
        
        return view('customer.profile.edit', compact('customer'));
    }
    
    /**
     * Update profil customer
     * URL: PUT /customer/profile
     */
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->customer_id . ',customer_id',
            'phone_number' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);
        
        // Update data dasar
        $customer->nama_lengkap = $request->nama_lengkap;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        
        // Update password jika diisi
        if ($request->filled('current_password')) {
            // Cek password lama
            if (!Hash::check($request->current_password, $customer->password)) {
                return back()->with('error', 'Password lama tidak sesuai!');
            }
            
            $customer->password = Hash::make($request->new_password);
        }
        
        $customer->save();
        
        return redirect()
            ->route('customer.profile.show')
            ->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Memproses upload foto profil
     * URL: POST /profile/update-photo
     */
    public function updatePhoto(Request $request)
    {
        // 1. Validasi file yang di-upload (harus gambar, maksimal 2MB)
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'avatar.required' => 'Silakan pilih foto terlebih dahulu.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format foto harus jpeg, png, atau jpg.',
            'avatar.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        // 2. Ambil data customer yang sedang login
        $customer = Auth::guard('customer')->user();

        // 3. Proses penyimpanan file
        if ($request->hasFile('avatar')) {
            
            // Hapus foto lama dari storage jika ada (supaya server tidak penuh)
            if ($customer->avatar) {
                Storage::disk('public')->delete('avatars/' . $customer->avatar);
            }

            // Simpan foto baru ke folder storage/app/public/avatars
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('avatars', $filename, 'public');

            // Simpan nama file ke tabel database
            $customer->avatar = $filename;
            $customer->save();
        }

        // 4. Kembali ke halaman profil dengan pesan sukses
        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}