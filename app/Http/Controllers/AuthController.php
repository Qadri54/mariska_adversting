<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;

class AuthController extends Controller
{
    // ============================================
    // 1. UNIFIED LOGIN (Admin & Customer Gabung)
    // ============================================

    /**
     * Tampilkan form login tunggal
     * URL: /login
     */
    public function showLoginForm()
    {
        // Pastikan file view-nya ada di 'resources/views/auth/login.blade.php'
        return view('auth.login');
    }

    /**
     * Proses login gabungan
     * URL: POST /login
     */
    public function login(Request $request)
    {
        // 1. Validasi Input (Kita namakan field-nya 'login_id' agar netral)
        $request->validate([
            'login_id' => 'required|string', // Bisa berupa Username (Admin) atau Email (Customer)
            'password' => 'required|string',
        ]);

        $loginId = $request->input('login_id');
        $password = $request->input('password');

        // 2. CEK LEVEL 1: APAKAH INI ADMIN? (Cek tabel 'users' via guard 'web')
        // Admin login menggunakan 'username'
        if (Auth::guard('web')->attempt(['username' => $loginId, 'password' => $password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect ke Dashboard Admin
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali, Admin!');
        }

        // 3. CEK LEVEL 2: APAKAH INI CUSTOMER? (Cek tabel 'customers' via guard 'customer')
        // Customer login menggunakan 'email'
        if (Auth::guard('customer')->attempt(['email' => $loginId, 'password' => $password], $request->remember)) {
            $request->session()->regenerate();

            // Redirect ke Halaman Utama (Home) atau halaman yang ingin dituju sebelumnya
            return redirect()->intended(route('home'))
                ->with('success', 'Login berhasil! Selamat datang.');
        }

        // 4. JIKA KEDUANYA GAGAL
        return back()
            ->withInput($request->only('login_id'))
            ->with('error', 'Username/Email atau password salah, atau akun tidak ditemukan.');
    }

    // ============================================
    // 2. REGISTER (KHUSUS CUSTOMER)
    // ============================================
    // Admin tidak bisa register lewat web demi keamanan

    /**
     * Tampilkan form register customer
     * URL: /register
     */
    public function showRegisterForm()
    {
        // Pastikan file view-nya ada di 'resources/views/auth/customer-register.blade.php'
        return view('auth.customer-register');
    }

    /**
     * Proses register customer baru
     * URL: POST /register
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat Customer Baru
        Customer::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login gabungan setelah daftar
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
    }

    // ============================================
    // 3. LOGOUT (UNIVERSAL)
    // ============================================

    /**
     * Logout user (baik admin maupun customer)
     * URL: POST /logout
     */
    public function logout(Request $request)
    {
        // Cek siapa yang sedang login dan logout-kan
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembali ke halaman login gabungan
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
