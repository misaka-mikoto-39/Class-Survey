<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GiangVien;

use App\Http\Requests;

use Validator;

use App\users;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

use File;

use App\Imports\LecturersImport;

use Illuminate\Support\MessageBag;

use Auth;

use Hash;

class LecturersManagerController extends Controller
{

  /**
  * Hàm đặt lại mật khẩu
  *
  * @param $request (resetid: tên tài khoản người dùng)
  *
  * @return json Kết quả thao tác
  */
  public function postReset(Request $request){
    $usesr = users::where('username', $request->resetid)->first();
    $usesr->password = Hash::make($request->resetid);
    $usesr->save();
    
    return response() -> json([
        'error' => false,
    ], 200);

  }


  /**
  * Hàm upload Danh sách giảng viên
  *
  * @param $request (File tải lên)
  *
  * @return json (Kết quả thao tác, thông báo lỗi)
  */
	public function postUpload(Request $request){
		if($request->hasFile('inputfile')){
	        $extension = File::extension(Input::file('inputfile')->getClientOriginalName());
	        if ($extension == "xlsx" /*|| $extension == "xls" || $extension == "csv"*/) {
	          $path = Input::file('inputfile');//->getPath();
	          try {

	            Excel::import(new LecturersImport, $path, '',\Maatwebsite\Excel\Excel::XLSX);

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
  * Hàm chỉnh sửa thông tin giảng viên
  *
  * @param $request (Thông tin giảng viên)
  *
  * @return json (Kết quả thao tác, thông báo lỗi)
  */
	public function postEdit(Request $request){
    $rules = [
        'editid' => 'required',
        'editname' => 'required',
        'editemail' => 'required|email',
      ];

     $message = [
        'editid.required' => 'Mã sinh viên không được để trống',
        'editname.required' => 'Họ và tên không được để trống',
        'editemail.required' => 'Email không được để trống',
        'email' => 'Email không hợp lệ',
      ];
      
     $validator = Validator::make($request->all(), $rules, $message);
      
     if($validator->fails()){
          return response() -> json([
                  'error' => true,
                  'message' => $validator->errors()
              ], 200);

     }else{
        $giangvien = GiangVien::where('gvid', $request->editid)->first();
        $giangvien->name = $request->editname;
        $giangvien->email = $request->editemail;
        $giangvien->save();
        return response() -> json([
                      'error' => false,
                      'message' => 'success'
                ], 200);
        }
    }

 
  /**
  * Hàm thêm giảng viên
  *
  * @param $request (Thông tin giảng viên)
  *
  * @return json (Kết quả thao tác, thông báo lỗi)
  */
  public function postAdd(Request $request){

    $rules = [
      'addid' => 'required|unique:GiangVien,gvid|unique:users,username',
      'addname' => 'required',
      'addemail' => 'required|email',
    ];

    $message = [
      'addid.required' => 'Mã giảng viên không được để trống',
      'addid.unique' => 'Mã giảng viên đã tồn tại',
      'addname.required' => 'Họ và tên không được để trống',
      'addemail.required' => 'Email không được để trống',
      'email' => 'Email không hợp lệ',
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
      $user->type = 'lecturers';
      $user->save();

      $giangvien = new GiangVien;
      $giangvien->gvid = $request->addid;
      $giangvien->name = $request->addname;
      $giangvien->email = $request->addemail;
      $giangvien->save();
      return response() -> json([
                'error' => false,
                'message' => 'success'
          ], 200);
      }
   }


  /**
  * Hàm xoá giảng viên
  *
  * @param $request (id giảng viên)
  *
  * @return json (Kết quả thao tác, thông báo lỗi)
  */
  public function postDelete(Request $request){
	    $user = users::where('username', $request->deleteid)->first();
	    $user->delete();
	    return response() -> json([
	                'error' => false,
	                'message' => 'success'
	          ], 200);
	}



}
