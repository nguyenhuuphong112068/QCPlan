<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Pages\AuditTrail\AuditTrialController;

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
            AuditTrialController::log('Login',"NA" , 0, $request->username, 'User Không Tồn Tại');
            return redirect()->route('login')->with('error', 'User Không Tồn Tại, Vui Lòng Đăng Nhập Lại!');
        }

       if (!password_verify($request->passWord, $getUser->passWord)){
            AuditTrialController::log('Login',"NA" , 0, '******', 'PassWord Không Chính Xác');
            return redirect()->route('login')->with('error', 'PassWord Không Chính Xác, Vui Lòng Đăng Nhập Lại!');
        }

        if ($getUser->changePWdate < date('Y-m-d')){
            AuditTrialController::log('Login',"NA" , 0, 'NA', 'Đăng Nhập Thành Công');
            return redirect()->route('login')->with('error', 'Thay đổi PassWord!');
        }

        $request->session()->put('user', [
        'username' => $getUser->userName,
        'fullName' => $getUser->fullName,
        'userGroup' => $getUser->userGroup,
        'department' => $getUser->deparment
        ]);

        AuditTrialController::log('Login',"NA" , 0, 'NA', 'Đăng Nhập Thành Công');

        return redirect()->route('pages.general.home');
    }

     public function logout(Request $request)
    {
        AuditTrialController::log('Log Out',"NA" , 0, 'NA', 'Đăng Xuất');
        $request->session()->flush(); 
        return redirect()->route('login');
    }
}
