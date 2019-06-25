<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use File;

use App\Imports\ClassImport;

use App\Http\Requests;

use Validator;

use App\SinhVien;

use App\LopMonHoc;

use App\DsLMH;

use App\TieuChi;

use App\Diem;

use App\TieuChiLMH;

use App\GiangVien;

use Illuminate\Support\MessageBag;


class ClassSurveyController extends Controller
{
    /**
    * Hàm lấy danh sách tiêu chí mặc định
    *
    * @param $request (lmhid: Mã lớp)
    *
    * @return json Danh sách tiêu chí (mã tiêu chí, tiêu chí, kiểu)
    */
    public function postTcList(Request $request){
        $tcidlist = array();
        foreach (TieuChiLMH::where('malmh', $request->lmhid)->cursor() as $tc) {
            $tentc = TieuChi::where('id', $tc->matieuchi)->first();
            array_push($tcidlist, array($tc->matieuchi, $tentc->tieuchi, $tentc->type));
        }
        return response() -> json([
                'tclist' => $tcidlist
            ], 200);
    }


    /**
    * Hàm ghi kết quả đánh giá vào databases
    *
    * @param $request (svid: mã sinh viên, tclist: Danh sách tiêu chí, diemlist: Danh sách điểm)
    *
    * @return json Kết quả thao tác
    */
	public function postAddSurvey(Request $request){
        $svlmh = DsLMH::where('masinhvien', $request->svid)->where('listid',$request->lmhid)->first();
        if($svlmh->status == 'n'){
            foreach (array_combine($request->tclist, $request->diemlist) as $tc => $point) {
                $diem = new Diem;
                $diem->madiem = $request->lmhid.' '.$request->svid;
                $diem->diem = (int) $point;
                $diem->matieuchi = (int) $tc;
                $diem->save();
            }
            $svlmh->status = 'y';
            $svlmh->save();
        }
        
        $lmh = DsLMH::where('listid', $request->lmhid)->where('status', 'n')->count();
        if($lmh == 0){
            $lmhchange = LopMonHoc::where('id', $request->lmhid)->first();
            $lmhchange->status = 'y';
            $lmhchange->save();
        }


        return response() -> json([
                'error' => false
            ], 200);

	}



    /**
    * Hàm lấy danh sách lớp môn học
    *
    * @param $request (userid: Mã sinh viên)
    *
    * @return json Danh sách lớp môn học (Mã lớp, học kỳ, tên môn học, tên giảng viên, id lớp môn học)
    */
    public function postClassList(Request $request)
    {
    	$lmhlist = array();
    	$lmhsl = 0;
    	foreach (DsLMH::where('masinhvien', $request->userid)->where('status', 'n')->cursor() as $id) {
    		$lmh = LopMonHoc::where('id', $id->listid)->where('status','n')->first();
    		if($lmh != null){
                $giangvien = GiangVien::where('gvid',$lmh->giangvien)->first();
    			array_push($lmhlist, array($lmh->malop, $lmh->hocky, $lmh->tenmonhoc,$giangvien->name, $lmh->id));
    			$lmhsl++;
    		}
    	}
    	if($lmhsl != 0){
    		return response() -> json([
    			'dslmh' => $lmhlist
    		], 200);
    	}else{
    		return response() -> json([
    			'dslmh' => null
    		], 200);
    	}
    	
    }
}
