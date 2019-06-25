<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

use File;

use App\Imports\ClassImport;

use App\Http\Requests;

use Validator;

use App\SinhVien;

use App\GiangVien;

use App\LopMonHoc;

use App\DsLMH;

use App\TieuChi;

use Illuminate\Support\MessageBag;

class SurveyManagerController extends Controller
{

	/**
    * Hàm bỏ tiêu chí khỏi danh sách tiêu chí mặc định
    *
    * @param $request (id tiêu chí)
    *
    * @return json (Kết quả)
    */
	public function postDeleteTC(Request $request){
    	$tc = TieuChi::where('id', $request->deleteid)->first();
		$tc->status = 'n';
		$tc->save();
		return response() -> json([
                'error' => false,
          ], 200);
    }

	
	/**
    * Hàm sửa tiêu chí
    *
    * @param $request (Thông tin tiêu chí)
    *
    * @return json (Kết quả, thông báo)
    */
	public function postEditTC(Request $request){
		$rules = [
			'tcid' => 'required',
			'tcnd' => 'required',
			'tct' => 'required',
	    ];
	    $message = [
	    	'tcid.required' => 'ID tiêu chí không được để trống',
	    	'tcnd.required' => 'Nội dung tiêu chí không được để trống',
	    	'tct.required' => 'Loại tiêu chí không được để trống'
	    ];
	    $validator = Validator::make($request->all(), $rules, $message);
	     if($validator->fails()){
	    		return response() -> json([
	                'error' => true,
	                'message' => $validator->errors()
	            ], 200);

	    }else{
	    	$tc = TieuChi::where('id', $request->tcid)->first();
	    	$tc->tieuchi = $request->tcnd;
	    	$tc->type = $request->tct;
	    	$tc->save();
	    	return response() -> json([
		                'error' => false,
		                'message' => 'Success'
		            ], 200);
	    }


	}


	/**
    * Hàm thêm tiêu chí
    *
    * @param $request (Thông tin tiêu chí)
    *
    * @return json (Kết quả, thông báo)
    */
	public function postAddTC(Request $request){
		$rules = [
			'adddata' => 'required|unique:TieuChi,tieuchi',
			'addtctype' =>'required'
	    ];
	    $message = [
	    	'adddata.required' => 'Nội dung tiêu chí không được để trống',
	    	'adddata.unique' => 'Nội dung tiêu chí đã tồn tại',
	    	'addtctype.required' => 'Loại tiêu chí không được để trống'

	    ];
	    $validator = Validator::make($request->all(), $rules, $message);
	    if($validator->fails()){
	    		return response() -> json([
	                'error' => true,
	                'message' => $validator->errors()
	            ], 200);

	    }else{
	    	if($request->addtype == 'no'){
	    		$errors = new MessageBag(['addtype' => 'Chọn 1 cách thêm']);
	    		return response() -> json([
	                'error' => true,
	                'message' => $errors
	            ], 200);
	    	}else{
	    		if($request->addtype == 'addnew'){
	    			$tc = new TieuChi;
	    			$tc->tieuchi = $request->adddata;
	    			$tc->status = 'y';
	    			$tc->type = $request->addtctype;
	    			$tc->save();
	    			return response() -> json([
		                'error' => false,
		                'message' => 'Success'
		            ], 200);

	    		}else if($request->addtype == 'select'){
	    			$tc = TieuChi::where('id', $request->adddata)->first();
	    			$tc->status = 'y';
	    			$tc->save();
	    			return response() -> json([
		                'error' => false,
		                'message' => 'Success'
		            ], 200);
	    		}
	    	}
	    }
	}


	/**
    * Hàm chỉnh sửa lớp môn học
    *
    * @param $request (thông tin lớp môn học)
    *
    * @return json (Kết quả, thông báo)
    */
	public function postEditLMH(Request $request){
		$rules = [
			'editmalop' => 'required',
	    	'edithocky' => 'required',
	    	'edittenmonhoc' => 'required',
	    	'editgiangvien' => 'required'
	    ];

	    $message = [
	    	'editmalop.required' => 'Mã lớp không được để trống',
	    	'edithocky.required' => 'Học kỳ không được để trống',
	    	'edittenmonhoc.required' => 'Tên môn học không được để trống',
	    	'editgiangvien.required' => 'Giảng viên không được để trống',
	    ];
	    
	    $validator = Validator::make($request->all(), $rules, $message);

	    if($validator->fails()){
	    		return response() -> json([
	                'error' => true,
	                'message' => $validator->errors()
	            ], 200);

	    }else{
	    	if($request->oldhocky == $request->edithocky){
	    		$lopmh = LopMonHoc::where('malop', $request->editmalop)->where('hocky', $request->oldhocky)->first();
		   		$lopmh->tenmonhoc = $request->edittenmonhoc;
		   		$lopmh->giangvien = $request->editgiangvien;
		   		$lopmh->save();
	    		return response() -> json([
	                    'error' => false,
	                    'message' => 'success'
	           		], 200);
	    	}else{
	    		$lopmhkt = LopMonHoc::where('malop', $request->editmalop)->where('hocky', $request->edithocky)->first();
		    	if ($lopmhkt != null) {
		    		$errors = new MessageBag(['edithocky' => 'Thông tin lớp môn học không hợp lệ']);
		    		return response() -> json([
		                    'error' => true,
		                    'message' => $errors
		           		], 200);
		    	}else{
		    		$lopmh = LopMonHoc::where('malop', $request->editmalop)->where('hocky', $request->oldhocky)->first();
			   		$lopmh->hocky = $request->edithocky;
			   		$lopmh->tenmonhoc = $request->edittenmonhoc;
			   		$lopmh->giangvien = $request->editgiangvien;
			   		/*foreach (DsLMH::where('listid', $request->oldhocky.' '.$request->editmalop)->cursor() as $sv) {
			   			$sv->listid = $lopmh->dssinhvien;
			   			$sv->save();
					}*/
					$lopmh->save();
			   		return response() -> json([
			                    'error' => false,
			                    'message' => 'success'
			           		], 200);
		    	}
	    	}
	   	}
	}


	/**
    * Hàm tải lên lớp môn học
    *
    * @param $request (file thông tin lớp môn học)
    *
    * @return json (Kết quả, thông báo)
    */
    public function postUpload(Request $request){

    	if($request->hasFile('inputfile')){
    		$extension = File::extension(Input::file('inputfile')->getClientOriginalName());
    		if ($extension == "xlsx" /*|| $extension == "xls" || $extension == "csv"*/) {
    			$path = Input::file('inputfile');//->getPath();
    			try {
    				Excel::import(new ClassImport, $path, '',\Maatwebsite\Excel\Excel::XLSX);
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
    * Hàm lấy danh sách sinh viên
    *
    * @param $request (id giảng viên, id lớp môn học)
    *
    * @return json (tên giảng viên, danh sách sinh viên)
    */
    public function rqStList(Request $request){
    	$dsidsv = array();
    	$giangvien = GiangVien::where('gvid', $request->idgv)->first();
    	//$lopmh = DsLMH::where('listid', $request->listid)->get(););
    	foreach (DsLMH::where('listid', $request->listid)->cursor() as $id) {
    		$info = SinhVien::where('svid', $id->masinhvien)->first();
    		if($info != null){
    			array_push($dsidsv, array($id->masinhvien, $info->name, $info->class));
    		}else {
    			array_push($dsidsv, array($id->masinhvien, 'no data', 'no data'));
    		}
    		
		}

    	return response() -> json([
    			'giangvien' => $giangvien->name,
    			'dssv' => $dsidsv
    		], 200);
    }


    /**
    * Hàm xoá lớp môn học
    *
    * @param $request (id lớp môn học)
    *
    * @return json (Kết quả)
    */
    public function postDeleteLMH(Request $request){
    	$lmh = LopMonHoc::where('malop', $request->deleteid)->where('hocky', $request->deletehk)->first();
		$lmh->delete();
		return response() -> json([
                'error' => false,
          ], 200);
    }


}
