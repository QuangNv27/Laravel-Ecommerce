<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $fillable = [
        'user_id',
        'product_id'
    ];
    // Quan hệ user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Quan hệ product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Thêm sản phẩm vào wishlist
    public static function addToWishList($userId, $productId)
    {
        if (!self::where('user_id', $userId)->where('product_id', $productId)->exists()) {
            self::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }
    }
    // Xóa sản phẩm khỏi wishlist
    public static function removeFromWishlist($userId, $productId)
    {
        self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    }
    // Lấy danh sách sản phẩm trong wishlist của người dùng
    public static function getWishlist($userId)
    {
        return self::where('user_id', $userId)
            ->with('product') // Để lấy thông tin sản phẩm
            ->get();
    }
}
