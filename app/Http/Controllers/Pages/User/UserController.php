<?php

namespace App\Http\Controllers\Pages\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
         public function index(){

                $deparments = DB::table('deparments')->where('active', true)->get();
                $userGroups = DB::table('usergroup')->where('active', true)->get();

                $datas = DB::table('user_management')->where ('isActive',1)->orderBy('created_at','desc')->get();
                
                session()->put(['title'=> 'Danh Sách Người Dùng']);
           
                return view('pages.User.list',['datas' => $datas, 'deparments' => $deparments, 'userGroups' => $userGroups]);
        }
    

        public function store (Request $request) {
                $request->validate([
                        'name' => 'required|string|max:255|unique:user_management,name',
                        'shortName' => 'required|string|max:255|unique:user_management,shortName',
                    
                ],[
                        'name.required' => 'Vui lòng nhập tên chỉ tiêu kiểm',
                        'shortName.required' => 'Vui lòng nhập tên viết tắt.',
                        'name.unique' => 'Chỉ tiêu kiểm đã tồn tại trong hệ thống.',
                        'shortName.unique' => 'Tên viết tắt đã tồn tại trong hệ thống.',
                ]);
                DB::table('user_management')->insert([
                        'userName' => $request->userName,
                        'userGroup' => $request->userGroup,
                        'passWord' => $request->passWord,
                        'fullName' => $request->fullName,
                        'deparment' => $request->fullName,
                        'groupName' => $request->groupName,
                        'mail' => $request->mail,
                        'changePWdate' => today() + 90,
                        'prepareBy' => session('user')['fullName'] ?? 'Admin',
                        'created_at' => now(),
                ]);
                return redirect()->back()->with('success', 'Đã thêm thành công!');    
        }

        public function update(Request $request){
               
                $request->validate([
                        'name' => 'required|string|max:255',
                        'shortName' => 'required|string|max:255',
                ],[
                        'name.required' => 'Vui lòng nhập tên chỉ tiêu kiểm',
                        'shortName.required' => 'Vui lòng nhập tên viết tắt.',
                ]);

               DB::table('user_management')->where('id', $request->id)->update([
                        'name' => $request->name,
                        'shortName' => $request->shortName,
                        'isActive' => true,
                        'prepareBy' => session('user')['fullName'],
                        'updated_at' => now(), 
                ]);
                return redirect()->back()->with('success', 'Cập nhật thành công!');
        }

        public function deActive(string|int $id){
          

               DB::table('user_management')->where('id', $id)->update([
                        'isActive' => false,
                        'prepareBy' => session('user')['fullName'],
                        'updated_at' => now(), 
                ]);
                return redirect()->back()->with('success', 'Vô Hiệu Hóa thành công!');
        }
}
