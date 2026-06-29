<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // 1. Cek Jika yang mengakses adalah Admin
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            // 2. Cek Jika yang mengakses adalah Customer (atau Tamu)

            // ========================================================
            // ||   TAMBAHKAN BARIS INI UNTUK PESAN NOTIFIKASI       ||
            // ========================================================
            session()->flash('error', 'Anda harus login terlebih dahulu untuk melanjutkan.');
            // ========================================================

            // Pastikan ini 'customer.login' (sesuai routes/web.php), BUKAN 'auth.login'
            return route('login');
        }
    }
}
