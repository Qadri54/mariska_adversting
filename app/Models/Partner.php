<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';
    protected $primaryKey = 'partner_id';

    protected $fillable = [
        'partner_name',
        'logo_url',
    ];

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Mendapatkan URL logo lengkap
     */
    public function getLogoUrlAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return asset('images/default-partner.png');
    }
}