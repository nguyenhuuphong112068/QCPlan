<?php

namespace App\Http\Controllers\Pages\Schedual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SchedualController extends Controller
{
    public function view(){
        session()->put(['title' => 'Lịch Kiểm Nghiệm']);

        $events = [
            [
                'id' => 1,
                'rowId' => 'device-1',
                'title' => 'Mẫu A1',
                'startDate' => '2025-07-25T08:00:00',
                'endDate' => '2025-07-25T10:00:00',
            ],
            [
                'id' => 2,
                'rowId' => 'device-1',
                'title' => 'Mẫu A2',
                'startDate' => '2025-07-25T10:30:00',
                'endDate' => '2025-07-25T12:30:00',
            ],
            [
                'id' => 3,
                'rowId' => 'device-2',
                'title' => 'Mẫu B1',
                'startDate' => '2025-07-25T09:00:00',
                'endDate' => '2025-07-25T10:00:00',
            ]
        ];


        $devices = [
            ['id' => 'device-1', 'label' => 'Thiết bị C'],
            ['id' => 'device-2', 'label' => 'Thiết bị B']
        ];

        return Inertia::render('GanttChart', [
            'title' => 'Lịch Kiểm Nghiệm',
            'user' => session('user'),
            'data' => $events,
            'rows' => $devices
        ]);
    }

    public function index(){

                $analysts = DB::table('analyst')->where ('active',1)->orderBy('created_at','desc')->get();
                $instruments = DB::table('instrument')->where ('active',1)->orderBy('created_at','desc')->get();
                $category = DB::table('product_category')->where ('active',1)->orderBy('created_at','desc')->get();

                $datas = DB::table('schedules')
                    ->select(
                        'schedules.*',
                        'product_category.name',
                        'product_category.code',
                        'product_category.testing',
                        'import.batch_no',
                        'import.stage',
                        'instrument.name as ins_name'
                    )
                    ->where('schedules.finished', 0)
                    ->leftJoin('import', 'schedules.imported_id', '=', 'import.id')
                    ->leftJoin('instrument', 'schedules.ins_Id', '=', 'instrument.id')
                    ->leftJoin('product_category', 'import.testing_code', '=', 'product_category.testing_code')
                    ->get();
        
                session()->put(['title'=> 'Danh Sách Mẫu Chờ Kiểm']);
        
                return view('pages.Schedual.list',['datas' => $datas,'category' => $category, 'instruments' => $instruments,  'analysts' => $analysts]);
        }
    

        public function store (Request $request) {
                $validator = Validator::make($request->all(), [
                        'imoported_amount' => 'required|numeric|gt:0', 
                        'batch_no' => 'required|string|min:5',
                        'experted_date' => 'required',
                        'stage' => 'required',
                ], [
                        'imoported_amount.required' => 'Vui lòng nhập số lượng mẫu',
                        'imoported_amount.numeric' => 'Số lượng mẫu là kiểu số',
                        'imoported_amount.gt' => 'Số lượng mẫu phải lớn hơn 0',

                        'batch_no.min' => 'Số lô phải có ít nhất min ký tự',
                        'batch_no.required' => 'Vui lòng nhập số lô',

                        'experted_date.required' => 'Vui lòng chọn ngày trả kết quả',

                        'stage.required' => 'Vui lòng nhập công đoạn',
                ]);
               

                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator, 'createErrors')->withInput();
                }


                DB::table('import')->insert([
                        'testing_code' => $request->testing_code,
                        'imoported_amount' => $request->imoported_amount,
                        'stage'  => $request->stage,
                        'experted_date'  => $request->experted_date,
                        'batch_no' => $request->batch_no,
                        'prepareBy' => session('user')['fullName'] ?? 'Admin',
                        'created_at' => now(),
                ]);
                return redirect()->back()->with('success', 'Đã thêm thành công!');    
        }

        public function update(Request $request){
               
                $validator = Validator::make($request->all(), [
                        'imoported_amount' => 'required|numeric|gt:0', 
                        'batch_no' => 'required|string|min:5',
                        'experted_date' => 'required',
                        'stage' => 'required',
                ], [
                        'imoported_amount.required' => 'Vui lòng nhập số lượng mẫu',
                        'imoported_amount.numeric' => 'Số lượng mẫu là kiểu số',
                        'imoported_amount.gt' => 'Số lượng mẫu phải lớn hơn 0',
                        'batch_no.min' => 'Số lô phải có ít nhất min ký tự',
                        'batch_no.required' => 'Vui lòng nhập số lô',
                        'experted_date.required' => 'Vui lòng chọn ngày trả kết quả',
                        'stage.required' => 'Vui lòng nhập công đoạn',
                ]);
                
                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator, 'updateErrors')->withInput();
                } 
                
                 DB::table('import')->where('id', $request->id)->update([
                        
                       
                        'imoported_amount' => $request->imoported_amount,
                        'stage'  => $request->stage,
                        'experted_date'  => $request->experted_date,
                        'batch_no' => $request->batch_no,
                        'prepareBy' => session('user')['fullName'] ?? 'Admin',
                        'updated_at' => now(),
                ]);
                return redirect()->back()->with('success', 'Đã thêm thành công!');   
        }

        public function deActive(string|int $id){
                
               DB::table('import')->where('id', $id)->update([
                        'isActive' => 0,
                        'prepareBy' => session('user')['fullName'],
                        'updated_at' => now(), 
                ]);
                return redirect()->back()->with('success', 'Vô Hiệu Hóa thành công!');
        }





}
