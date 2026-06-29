<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'customer_id',
        'order_number',
        'order_date',
        'total_amount',
        'payment_proof_url',
        'status',
        'verified_by',
        'shipping_method',
        'shipping_address',
        'receiver_name',
        'receiver_phone',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // ============================================
    // LOGIKA STATUS TERPUSAT
    // ============================================

    /**
     * Mendapatkan daftar status yang dianggap "Perlu Diproses"
     * Digunakan oleh DashboardController dan OrderController untuk sinkronisasi data
     */
    public static function getStatusProses()
    {
        return ['Pending', 'Awaiting Approval', 'Verified', 'Processing', 'Ready_for_pickup'];
    }

    // ============================================
    // RELASI
    // ============================================

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getPaymentProofUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }
    
        $cleanPath = $value;

        $prefixesToRemove = [
            'http://127.0.0.1:8000/',
            'https://aryaadvertising.com/',
            'storage/payment_proofs/',
            'payment_proofs/'
        ];

        foreach ($prefixesToRemove as $prefix) {
            if (Str::startsWith($cleanPath, $prefix)) {
                $cleanPath = Str::after($cleanPath, $prefix);
            }
        }

        return asset('storage/payment_proofs/' . $cleanPath);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Pending' => 'warning',
            'Processing' => 'info',
            'Completed' => 'success',
            'Cancelled' => 'danger',
            'Awaiting Approval' => 'warning',
            'Verified' => 'info',
            'Ready_for_pickup' => 'success',
        ];

        return $badges[$this->status] ?? 'secondary';
    }
}