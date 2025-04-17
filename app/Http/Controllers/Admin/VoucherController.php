<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:0',
            'per_user_limit' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
        Voucher::create($data);
        return redirect()->route('vouchers.index')->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
        return view('admin.vouchers.show',compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        //
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
        $data = $request->validate([
            'is_active' => 'nullable|boolean',
        ]);
        $voucher->update([
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('vouchers.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success','Đã xóa');
    }
}
