<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';
    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'service_id',
        'title',
        'image_url',
        'description',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * Gallery dimiliki oleh satu Service
     * (Satu foto galeri masuk dalam satu kategori layanan)
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Mendapatkan URL gambar lengkap
     */
    public function getImageUrlAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return asset('images/default-gallery.png');
    }
}