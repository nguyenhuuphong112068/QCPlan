<?php

namespace App\Http\Controllers\Pages\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
           public function index(){

                $category = DB::table('product_category')->where ('active',1)->orderBy('created_at','desc')->get();

                $datas = DB::table('import')
                ->select('import.*', 'product_category.name', 'product_category.testing','product_category.testing_code', 'product_category.sample_Amout', 'product_category.unit')
                ->where ('import.Active',1)
                ->leftJoin('product_category', 'import.testing_code', 'product_category.testing_code')
                ->orderBy('created_at','desc')->get();
               
                
                session()->put(['title'=> 'Danh Sách Mẫu Chờ Kiểm']);
  
                return view('pages.Import.list',['datas' => $datas,'category' => $category ]);
        }
    

        public function store (Request $request) {
                $validator = Validator::make($request->all(), [
                'userName' => 'required|string|max:10|min:5|unique:user_management,userName',
                'passWord' => [
                        'required','string','min:6','max:255',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',],
                'fullName' => 'required|string|max:255|min:5',
                'userGroup' => 'required',
                'deparment' => 'required',
                'mail' => 'required',
                'groupName' => 'required',

                ], [
                'userName.required' => 'Vui lòng nhập tên đăng nhập.',
                'userName.unique' => 'Tên đăng nhập đã tồn tại.',
                'userName.min' => 'Tên đăng nhập phải có ít nhất :min ký tự.',
                'userName.max' => 'Tên đăng nhập không vượt quá :max ký tự.',

                'passWord.required' => 'Vui lòng nhập mật khẩu.',
                'passWord.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
                'passWord.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.',
                
                'fullName.required' => 'Vui lòng nhập tên đăng nhập.',
                'fullName.min' => 'Tên người dùng phải có ít nhất :min ký tự.',
                'fullName.max' => 'Tên người dùng không vượt quá :max ký tự.',
                
                'userGroup.required' => 'Vui lòng chọn phân quyền',

                'deparment.required' => 'Vui chọn Phòng Ban',

                'mail.required' => 'Nếu Không Có Mail Vui Lòng Nhập NA',

                'groupName.required' => 'Vui lòng chọn tổ',

                ]);
               

                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator, 'createErrors')->withInput();
                }

                DB::table('user_management')->insert([
                        'userName' => $request->userName,
                        'fullName' => $request->fullName,
                        'userGroup' => $request->userGroup,
                        'deparment' => $request->deparment,
                        'groupName' => $request->groupName,
                        'mail' => $request->mail,
                        'changePWdate' => today()->addDays(90),
                        'prepareBy' => session('user')['fullName'] ?? 'Admin',
                        'created_at' => now(),
                ]);
                return redirect()->back()->with('success', 'Đã thêm thành công!');    
        }

        public function update(Request $request){
               
                $validator = Validator::make($request->all(), [
                'fullName' => 'required|string|max:255|min:5',
                'userGroup' => 'required',
                'deparment' => 'required',
                'mail' => 'required',
                'groupName' => 'required',

                ], [
                        

                'fullName.required' => 'Vui lòng nhập tên đăng nhập.',
                'fullName.min' => 'Tên người dùng phải có ít nhất :min ký tự.',
                'fullName.max' => 'Tên người dùng không vượt quá :max ký tự.',
                
                'userGroup.required' => 'Vui lòng chọn phân quyền',

                'deparment.required' => 'Vui chọn Phòng Ban',

                'mail.required' => 'Nếu Không Có Mail Vui Lòng Nhập NA',

                'groupName.required' => 'Vui lòng chọn tổ',

                ]);
                
                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator, 'updateErrors')->withInput();
                } 
                
                 DB::table('user_management')->where('id', $request->id)->update([
                        
                        'fullName' => $request->fullName,
                        'userGroup' => $request->userGroup,
                        'deparment' => $request->deparment,
                        'groupName' => $request->groupName,
                        'mail' => $request->mail,
                        'prepareBy' => session('user')['fullName'] ?? 'Admin',
                        'updated_at' => now(),
                ]);
                return redirect()->back()->with('success', 'Đã thêm thành công!');   
        }

        public function deActive(string|int $id){
                
               DB::table('user_management')->where('id', $id)->update([
                        'isActive' => 0,
                        'prepareBy' => session('user')['fullName'],
                        'updated_at' => now(), 
                ]);
                return redirect()->back()->with('success', 'Vô Hiệu Hóa thành công!');
        }
}
