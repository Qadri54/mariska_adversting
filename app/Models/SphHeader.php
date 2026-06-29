<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SphHeader extends Model
{
    use HasFactory;

    protected $table = 'sph_headers';
    protected $primaryKey = 'sph_id';

    protected $fillable = [
        'sph_number',
        'sph_date',
        'client_name',
        'client_up',
        'job_title',
        'user_id',
        'rincian_image', 
        'design_image',
        'total_modal',
        'unit_multiplier',
        'total_biaya',
        'ppn_amount',
        'pph_amount',
        'grand_total',
        'terms_waktu',
        'terms_pembayaran',
    ];

    protected $casts = [
        'sph_date' => 'date',
        'total_modal' => 'decimal:2',
        'total_biaya' => 'decimal:2',
        'ppn_amount' => 'decimal:2',
        'pph_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * SphHeader dimiliki oleh satu User (Admin)
     * (Satu SPH dibuat oleh satu Admin)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * SphHeader memiliki banyak SphDetail
     * (Satu SPH punya banyak rincian item)
     */
    public function details()
    {
        return $this->hasMany(SphDetail::class, 'sph_id', 'sph_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Format grand total dengan Rupiah
     */
    public function getFormattedGrandTotalAttribute()
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }
}