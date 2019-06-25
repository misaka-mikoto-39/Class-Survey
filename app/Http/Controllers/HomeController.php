<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\LopMonHoc;

use App\SinhVien;

use App\TieuChi;

use App\GiangVien;

use App\users;

use Hash;

use Illuminate\Support\MessageBag;

use Validator;



class HomeController extends Controller
{
	public function _construct(){
		$this->middleware('auth');
	}

    /**
    * Hàm đổi mật khẩu
    *
    * @param $request (oldpassword: Mật khẩu cũ, newpassword: Mật khẩu mới, renewpasswod: Nhập lại mật khẩu)
    *
    * @return json (error: báo lỗi, message: thông báo)
    */
    public function postChangePassword(Request $request){
        $rules = [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'renewpassword' => 'required',
        ];
        $message = [
            'oldpassword.required' => 'Mật khẩu không được để trống',
            'newpassword.required' => 'Mật khẩu không được để trống',
            'renewpassword.required' => 'Mật khẩu không được để trống',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return response() -> json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
            //return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $oldp = bcrypt($request->oldpassword);
            if(Hash::check($request->oldpassword, Auth::user()->password)){
                if($request->newpassword == $request->renewpassword){
                    $usesr = Auth::user();
                    $usesr->password = Hash::make($request->newpassword);
                    $usesr->save();
                    
                    return response() -> json([
                        'error' => false,
                        'message' => 'done'
                    ], 200);

                }else{
                    $errors = new MessageBag(['bothnew' => 'Mật khẩu mới phải giống nhau']);
                    return response() -> json([
                        'error' => true,
                        'message' => $errors
                    ], 200);
                   
                }
            }else{
                $errors = new MessageBag(['oldpassword' => 'Mật khẩu cũ không chính xác']);
                return response() -> json([
                        'error' => true,
                        'message' => $errors
                    ], 200);
            }
        }
        
    }

    /**
    * Hàm trả về trang kết quả khảo sát của giảng viên
    */
    public function getLecturersReport(){
            $lopmonhoc = LopMonHoc::where('giangvien', Auth::user()->username)->get();
            return view('home.lecturers-report', ['lopmonhoc' => $lopmonhoc]);
    }

    /**
    * Hàm trả về trang đánh giá môn học
    */
    public function getClassSurvey(){
            $tieuchi = TieuChi::where('status', 'y')->get();
            return view('home.class-survey', ['tieuchi' => $tieuchi]);
    }

    /**
    * Hàm trả về trang chủ
    */
    public function getIndex(){
    		return view('home.index');
    }

    /**
    * Hàm đăng xuất
    */
    public function getLogout(){
    	Auth::logout();
    	return redirect('/');

	
    }

    /**
    * Hàm trả về trang quản lý sinh viên
    */
    public function getStudentManager(){
            $sinhvien = SinhVien::all();
    		return view('home.student-manager',['sinhvien' => $sinhvien]);
 	
    }

    /**
    * Hàm trả về trang quản lý giảng viên
    */
    public function getLecturersManager(){
        $giangvien = GiangVien::all();

    	return view('home.lecturers-manager',['giangvien' => $giangvien]);    	
    }

    /**
    * Hàm trả về trang quản lý khảo sát
    */
    public function getSurveyManager(){

            $lopmonhoc = LopMonHoc::all();
            $tieuchi = TieuChi::all();
    		return view('home.survey-manager', ['lopmonhoc' => $lopmonhoc], ['tieuchi' => $tieuchi]);
  	
    }

    /**
    * Hàm trả về trang kết quả khảo sát của admin
    */
    public function getReport(){
        $lopmonhoc = LopMonHoc::all();
    	return view('home.report', ['lopmonhoc' => $lopmonhoc]);
    }

    /**
    * Hàm trả về trang đổi mật khẩu
    */
    public function getChangePassword(){

    		return view('home.change-password');

    }
}
