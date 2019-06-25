<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use Auth;

use Illuminate\Support\MessageBag;


class LoginController extends Controller
{
    /**
    * Hàm trả về trang đăng nhập
    *
    * @return trang đăng nhập
    */
    public function login(){
    	return view('home.login');
    }


    /**
    * Hàm đăng nhập
    *
    * @param $request (thông tin đăng nhập)
    *
    * @return json (Kết quả thao tác, thông báo)
    */
    public function postLogin(Request $request){
    	$rules = [
    		'username' => 'required',
    		'password' => 'required',
    	];
    	$message = [
    		'username.required' => 'Tên người dùng không được để trống',
    		'password.required' => 'Mật khẩu không được để trống',
    	];

    	$validator = Validator::make($request->all(), $rules, $message);
    	
    	if($validator->fails()){
    		return response() -> json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
            //return redirect()->back()->withErrors($validator)->withInput();
    	}else{
    		$remember = $request->has('remember') ? true : false;
    		$username = $request->input('username');
    		$password = $request->input('password');
    		if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
                return response() -> json([
                    'error' => false,
                    'message' => 'success'
                ], 200);

    		} else {
    			$errors = new MessageBag(['errorlogin' => 'Thông tin đăng nhập không chính xác']);
                return response() -> json([
                    'error' => true,
                    'message' => $errors
                ], 200);
    		}
    	}
    }
}
