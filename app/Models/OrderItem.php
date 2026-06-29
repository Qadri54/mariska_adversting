<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'item_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'calculated_price',
        'subtotal',
        'specifications',
        'custom_details',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'calculated_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'specifications' => 'json',
        'custom_details' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * OrderItem dimiliki oleh satu Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * OrderItem merujuk ke satu Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Format calculated price dengan Rupiah
     */
    public function getFormattedCalculatedPriceAttribute()
    {
        return 'Rp ' . number_format($this->calculated_price, 0, ',', '.');
    }

    /**
     * Format subtotal dengan Rupiah
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
