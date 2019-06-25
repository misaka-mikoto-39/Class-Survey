<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SinhVien;

use App\Http\Requests;

use Validator;

use App\users;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

use File;

use App\Imports\StudentImport;

use Illuminate\Support\MessageBag;

use Hash;

class StudentManagerController extends Controller
{


    /**
    * Hàm đặt lại mật khẩu
    *
    * @param $request (id sinh viên)
    *
    * @return json (Kết quả thao tác)
    */
    public function postReset(Request $request){
      $usesr = users::where('username', $request->resetid)->first();
      $usesr->password = Hash::make($request->resetid);
      $usesr->save();
      
      return response() -> json([
          'error' => false,
          'message' => 'done'
      ], 200);

    }


    /**
    * Hàm tải lên danh sách sinh viên
    *
    * @param $request (file danh sách sinh viên)
    *
    * @return json (Kết quả thao tác, thông báo)
    */
    public function postUpload(Request $request){

      if($request->hasFile('inputfile')){
          $extension = File::extension(Input::file('inputfile')->getClientOriginalName());
          if ($extension == "xlsx" /*|| $extension == "xls" || $extension == "csv"*/) {
            $path = Input::file('inputfile');//->getPath();
            try {

              Excel::import(new StudentImport, $path, '',\Maatwebsite\Excel\Excel::XLSX);

              return response() -> json([
                'error' => false,
                'message' => 'Nice'
              ], 200);
            } catch (Exception $e) {
              return response() -> json([
                'error' => true,
                'message' => 'File không hợp lệ'
              ], 200);
            }
                  
          }else{
            return response() -> json([
              'error' => true,
              'message' => 'Vui lòng chọn file đúng định dạng'
              ], 200);

          }
        }else{
          return response() -> json([
            'error' => true,
            'message' => 'Không được để trống'
          ], 200);
        }
      }


    /**
    * Hàm sửa thông tin sinh viên
    *
    * @param $request (thông tin sinh viên)
    *
    * @return json (Kết quả, thông báo)
    */
    public function postEdit(Request $request){
        $rules = [
          'editid' => 'required',
          'editname' => 'required',
          'editemail' => 'required|email',
          'editclass' => 'required'
        ];

        $message = [
          'editid.required' => 'Mã sinh viên không được để trống',
          'editname.required' => 'Họ và tên không được để trống',
          'editemail.required' => 'Email không được để trống',
          'email' => 'Email không hợp lệ',
          'editclass.required' => 'Lớp không được để trống',
        ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        
        if($validator->fails()){
            return response() -> json([
                    'error' => true,
                    'message' => $validator->errors()
                ], 200);

       }else{
          $sinhvien = SinhVien::where('svid', $request->editid)->first();
          $sinhvien->name = $request->editname;
          $sinhvien->email = $request->editemail;
          $sinhvien->class = $request->editclass;
          $sinhvien->save();
          return response() -> json([
                        'error' => false,
                        'message' => 'success'
                  ], 200);
          }
      }

    /**
    * Hàm thêm sinh viên
    *
    * @param $request (thông tin sinh viên)
    *
    * @return json (kết quả, thông báo)
    */
    public function postAdd(Request $request){

      $rules = [
        'addid' => 'required|unique:SinhVien,svid|unique:users,username',
        'addname' => 'required',
        'addemail' => 'required|email',
        'addclass' => 'required'
      ];

      $message = [
        'addid.required' => 'Mã sinh viên không được để trống',
        'addid.unique' => 'Mã sinh viên đã tồn tại',
        'addname.required' => 'Họ và tên không được để trống',
        'addemail.required' => 'Email không được để trống',
        'email' => 'Email không hợp lệ',
        'addclass.required' => 'Lớp không được để trống',
      ];

      $validator = Validator::make($request->all(), $rules, $message);

      if($validator->fails()){
          return response() -> json([
                  'error' => true,
                  'message' => $validator->errors()
              ], 200);

      }else{

        $user = new users;
        $user->username = $request->addid;
        $user->password = bcrypt($request->addid);
        $user->type = 'student';
        $user->save();

        $sinhvien = new SinhVien;
        $sinhvien->svid = $request->addid;
        $sinhvien->name = $request->addname;
        $sinhvien->email = $request->addemail;
        $sinhvien->class = $request->addclass;
        $sinhvien->save();
        return response() -> json([
                  'error' => false,
                  'message' => 'success'
            ], 200);
        }
     }


    /**
    * Hàm xoá sinh viên
    *
    * @param $request (mã sinh viên)
    *
    * @return json (Kết quả)
    */
    public function postDelete(Request $request){
      $user = users::where('username', $request->deleteid)->first();
      $user->delete();
      return response() -> json([
                  'error' => false,
            ], 200);
    }

}

  


	



	
   



	
