<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SphDetail extends Model
{
    use HasFactory;

    protected $table = 'sph_details';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'sph_id',
        'description',
        'quantity',
        'unit',
        'total_price',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * SphDetail dimiliki oleh satu SphHeader
     * (Satu rincian item hanya milik satu SPH)
     */
    public function sphHeader()
    {
        return $this->belongsTo(SphHeader::class, 'sph_id', 'sph_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Format total price dengan Rupiah
     */
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}