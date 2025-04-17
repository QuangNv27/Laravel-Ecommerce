<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class ClientController extends Controller
{
    //
    public function edit()
    {
        $user = Auth::user();
        return view('client.profiles.index',compact('user'));
    }
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $data = $request->validate([
                'name' => 'required|string|max:50',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:50',
            ]);
        
            $user->update($data);
        
            return back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'current_password'=>'required',
            'new_password'=>'required|min:6|confirmed',
        ]);
        if(!Hash::check($request->current_password,$user->password))
        {
            return back()->withErrors(['current_password'=>'Mật khẩu không chính xác']);
        }
        $user->password = Hash::make($request->new_password);
        $user->update($data);
        return back()->with('success','Đổi mật khẩu thành công');
    }
}
