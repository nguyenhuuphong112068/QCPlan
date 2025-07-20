<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller{

// dd ($request->all());  

    public function showLogin(){
        session()->put(['title'=> 'KÊ HOẠCH KIỂM NGHIỆM']);
        return view('login');}


     public function login(Request $request)
    {
        // $hash = password_hash("123456", PASSWORD_DEFAULT);
        // dd($hash);

        $getUser = DB::table ('user_Management')->where ('userName', '=' ,$request->username)->first();

        if (is_null($getUser)){
            return redirect()->route('login')->with('error', 'User Không Tồn Tại, Vui Lòng Đăng Nhập Lại!');
        }

       if (!password_verify($request->passWord, $getUser->passWord)){
            return redirect()->route('login')->with('error', 'PassWord Không Chính Xác, Vui Lòng Đăng Nhập Lại!');
        }

        if ($getUser->changePWdate < date('Y-m-d')){
            return redirect()->route('login')->with('error', 'Thay đổi PassWord!');
        }

        $request->session()->put('user', [
        'username' => $getUser->userName,
        'fullName' => $getUser->fullName,
        'userGroup' => $getUser->userGroup,
        'groupCode' => $getUser->groupCode,
        'department' => $getUser->deparment
        ]);
        return redirect()->route('pages.general.home');
    }

     public function logout(Request $request)
    {
        
        $request->session()->flush(); // Xoá toàn bộ session
        return redirect()->route('login');
    }
}
