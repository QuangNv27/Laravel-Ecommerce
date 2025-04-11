<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'color',
        'size',
        'price',
        'stock',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class,'varinat_id');
    }
}
