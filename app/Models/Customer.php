<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'email',
        'password',
        'nama_lengkap',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * Customer memiliki banyak Order
     * (Pelanggan bisa memiliki banyak riwayat pesanan)
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}