<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'service_id',
        'nama_produk',
        'base_price',
        'unit_type',
        'image_url',
        'description',
        'finishing_options',
        'material_options', // <-- 1. Pastikan ini ada
        'profit_margin',
    ];

    // ===========================================================
    // ||  INI BAGIAN PENTING UNTUK MENGATASI ERROR TERSEBUT  ||
    // ===========================================================
    protected $casts = [
        'base_price' => 'decimal:2',
        'finishing_options' => 'array', // <-- Wajib: Agar array diubah jadi JSON
        'material_options' => 'array',  // <-- Wajib: Agar array diubah jadi JSON
        'profit_margin' => 'integer',
    ];

    // ============================================
    // RELASI
    // ============================================

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    // ============================================
    // ACCESSOR (LOGIKA PINTAR)
    // ============================================

    /**
     * Mendapatkan URL gambar lengkap
     */
    public function getImageUrlAttribute($value)
    {

        // 1. Cek apakah ada nilai
        if (!$value) {
            return asset('images/default-product.png');
        }

        // 2. Cek apakah nilai sudah berupa URL lengkap (mengandung 'http' atau 'https')
        if (Str::startsWith($value, ['http://', 'https://'])) {
            // Jika sudah URL lengkap, gunakan langsung (MENGATASI DOUBLE URL)
            // Ini untuk data lama yang mungkin salah simpan
            return $value;
        }

        // 3. Jika nilai berupa path relatif (seperti 'products/neonbox.jpg')
        // Ini adalah format ideal. Kita tambahkan 'storage/' dan asset()
        // Ini mengasumsikan file disimpan di storage/app/public/
        return asset('storage/' . $value);
    }

    /**
     * Hitung Harga Jual Otomatis
     * Rumus: Modal + (Modal * Margin%)
     */
    public function getSellingPriceAttribute()
    {
        // Ambil margin dari database, kalau kosong pakai default 20%
        $margin = $this->profit_margin ?? 20;

        // Hitung profit
        $profit = $this->base_price * ($margin / 100);

        // Kembalikan Harga Jual (Modal + Profit)
        return $this->base_price + $profit;
    }

    /**
     * Format Rupiah pakai Harga Jual
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->selling_price, 0, ',', '.');
    }
}
