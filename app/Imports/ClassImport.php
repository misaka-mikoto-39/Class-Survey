<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\LopMonHoc;
use App\DsLMH;
use App\TieuChiLMH;
use App\TieuChi;
use App\GiangVien;
use App\users;
use App\SinhVien;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ClassImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row)
    {
    	$lopmh = new LopMonHoc;

    	$batdau = false;
    	foreach ($row as $rows) {
    		if(trim($rows[0],'  ') == 'Giảng viên:'){
    			$lopmh->giangvien = trim($rows[4],'  ');
                $gvcheck = users::where('username',$lopmh->giangvien)->first();
                if($gvcheck == null){
                    $gvuser = new users;
                    $gvuser->username = trim($rows[4],'  ');
                    $gvuser->password = bcrypt(trim($rows[4],'  '));
                    $gvuser->type = 'lecturers';
                    $giangvien = new GiangVien;
                    $giangvien->gvid = trim($rows[4],'  ');
                    $giangvien->name = trim($rows[2],'  ');
                    $giangvien->email = trim($rows[4],'  ').'@vnu.edu.vn';
                    $gvuser->save();
                    $giangvien->save();
                }
    		}elseif (trim($rows[0],'  ') == 'Lớp môn học:')  {
    			$lopmh->malop = trim($rows[2],'  ');
    		}elseif(trim($rows[0],'  ') == 'Môn học:'){
    			$lopmh->tenmonhoc = trim($rows[2],'  ');
    		}elseif (trim($rows[0],'  ') == 'Học kỳ:') {
    			$lopmh->hocky = trim($rows[2],'  ');
    		}elseif ($batdau == true) {
                if(trim($rows[1],'  ') == ""){
                    $lopmh->save();
                    $batdau = false;
                    break;
                }else{
                    $dslopmh = new DsLMH;
                    $dslopmh->listid = $lopmh->id;
                    $dslopmh->masinhvien = trim($rows[1],'  ');
                    $dslopmh->madiem = $lopmh->id.' '.$dslopmh->masinhvien;
                    $dslopmh->status = 'n';
                    $svcheck = users::where('username', $dslopmh->masinhvien)->first();
                    if($svcheck == null){
                        $svuser = new users;
                        $svuser->username = trim($rows[1],'  ');
                        $svuser->password = bcrypt(trim($rows[1],'  '));
                        $svuser->type = 'student';
                        $sinhvien = new SinhVien;
                        $sinhvien->svid = trim($rows[1],'  ');
                        $sinhvien->name = trim($rows[2],'  ');
                        $sinhvien->email = trim($rows[1],'  ').'@vnu.edu.vn';
                        $sinhvien->class = trim($rows[4],'  ');
                        $svuser->save();
                        $sinhvien->save();
                    }
                    $dslopmh->save();
                }
    		}elseif (trim($rows[1],'  ') == 'Mã SV'){
                $lopkiemtra = LopMonHoc::where('malop', $lopmh->malop)->where('hocky', $lopmh->hocky)->first();
                if($lopkiemtra != null){
                    break;
                }else {
                    if($lopmh->malop != null && $lopmh->hocky != null){
                        $lopmh->status = 'n';
                        $lopmh->save();
                        foreach (TieuChi::where('status', 'y')->cursor() as $dstc) {
                            $tieuchilmh = new TieuChiLMH;
                            $tieuchilmh->malmh = $lopmh->id;
                            $tieuchilmh->matieuchi = $dstc->id;
                            $tieuchilmh->save();
                        }
                        $batdau = true;
                    }else {
                        break;
                    }
                }
    		}
    	}
   	}
}
