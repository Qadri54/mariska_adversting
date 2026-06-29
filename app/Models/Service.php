<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * Service memiliki banyak Product
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'service_id', 'service_id');
    }

    /**
     * Service memiliki banyak Gallery
     * REVISI: Mengubah nama method dari 'gallery' menjadi 'galleries' 
     * agar Laravel otomatis membuat variabel 'galleries_count' 
     * saat menggunakan withCount('galleries') di Controller.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'service_id', 'service_id');
    }
}