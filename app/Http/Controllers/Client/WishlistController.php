<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    // Thêm sản phẩm vào wishlist
    public function add(Request $request, $productId)
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        if ($user) {
            // Kiểm tra xem sản phẩm đã có trong wishlist của người dùng chưa
            if (!Wishlist::where('user_id', $user->id)->where('product_id', $productId)->exists()) {
                Wishlist::addToWishlist($user->id, $productId);
                return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích!');
            } else {
                return redirect()->back()->with('info', 'Sản phẩm đã có trong danh sách yêu thích của bạn.');
            }
        }

        return redirect()->route('login');
    }

    // Xóa sản phẩm khỏi wishlist
    public function remove(Request $request, $productId)
    {
        $user = Auth::user(); // Lấy người dùng hiện tại

        if ($user) {
            // Kiểm tra xem sản phẩm có trong wishlist của người dùng không
            $wishlistItem = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($wishlistItem) {
                $wishlistItem->delete();
                return redirect()->back()->with('success', 'Sản phẩm đã bị xóa khỏi danh sách yêu thích!');
            } else {
                return redirect()->back()->with('info', 'Sản phẩm không có trong danh sách yêu thích của bạn.');
            }
        }

        return redirect()->route('login');
    }

    // Xem danh sách sản phẩm yêu thích của người dùng
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $wishlistItems = Wishlist::getWishlist($user->id);
            return view('client.wishlists.index', compact('wishlistItems'));
        }

        return redirect()->route('login');
    }
}
