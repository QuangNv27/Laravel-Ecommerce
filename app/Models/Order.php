<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'voucher_id',
        "final_total",
        "discount_amount",
        "shipping_fee",
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
