<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * User memiliki banyak SPH Header
     * (Admin bisa membuat banyak SPH)
     */
    public function sphHeaders()
    {
        return $this->hasMany(SphHeader::class, 'user_id', 'user_id');
    }

    /**
     * User memiliki banyak Order yang diverifikasi
     * (Admin bisa memverifikasi banyak Order)
     */
    public function verifiedOrders()
    {
        return $this->hasMany(Order::class, 'verified_by', 'user_id');
    }

    
}
