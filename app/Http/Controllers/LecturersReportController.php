<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use File;

use App\Imports\ClassImport;

use App\Http\Requests;

use Validator;

use App;

use App\SinhVien;

use App\LopMonHoc;

use App\DsLMH;

use App\TieuChi;

use App\TieuChiLMH;

use App\Diem;

use App\GiangVien;

use PDF;

use Illuminate\Support\MessageBag;

class LecturersReportController extends Controller
{

    /**
    * Hàm xuất file pdf
    *
    * @param $request (code html)
    *
    * @return file pdf
    */
    public function postDownloadPdf(Request $request){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<style>
            table {
              border-collapse: collapse;
            }

            table, td, th, tr {
              border: 1px solid black;
            }
            </style><div charset="UTF-8" style="font-family: DejaVu Sans; font-weight: normal; font-style: normal; font-variant: normal;"> <h3 style="text-align: center;">KẾT QUẢ KHẢO SÁT</h3>'.$request->get('lmhyeshtml').'</div>');
        return $pdf->stream('Report.pdf');
    }


    /**
    * Hàm lấy thông tin lớp môn học đã hoàn thành khảo sát
    *
    * @param $request (id lớp môn học)
    *
    * @return json 
    */
    public function postLMHYesData(Request $request){
        $svyes = DsLMH::where('listid', $request->lmhid)->where('status', 'y')->count();
        $slsv = DsLMH::where('listid', $request->lmhid)->count();
        $giangvien = GiangVien::where('gvid', $request->giangvien)->first();
        $dstc = array();
        foreach (TieuChiLMH::where('malmh', $request->lmhid)->cursor() as $tc) {
            $tcavg =  Diem::where('madiem', 'like', $request->lmhid.'%')->where('matieuchi', $tc->matieuchi)->avg('diem');
            $tentc = TieuChi::where('id', $tc->matieuchi)->first();
            $tcsd = 0;
            foreach (Diem::where('madiem', 'like', $request->lmhid.'%')->where('matieuchi', $tc->matieuchi)->cursor() as $point) {
                $tcsd = $tcsd + (($point->diem - $tcavg) * ($point->diem - $tcavg));
            }
            $sld = Diem::where('madiem', 'like', $request->lmhid.'%')->where('matieuchi', $tc->matieuchi)->count();
            if($sld != 0){
                $tcsd = sqrt($tcsd/$sld);
            }

            //cùng môn, khác gv
            $sllop = 0;
            $avgalllop = 0;
            foreach (LopMonHoc::where('malop','like', substr($request->malop, 0, 7).'%')->where('giangvien', '!=', $request->giangvien)->cursor() as $class) {
                $avgalllop = $avgalllop + Diem::where('madiem', 'like', $class->id)->where('matieuchi', $tc->matieuchi)->avg('diem');
                $sllop++;
            }
            if($sllop != 0){
                $avgalllop = $avgalllop/$sllop;
            }
            $classsd = 0;
            foreach (LopMonHoc::where('malop','like', substr($request->malop, 0, 7).'%')->where('giangvien', '!=', $request->giangvien)->cursor() as $class) {
                $pl = Diem::where('madiem', 'like', $class->id)->where('matieuchi', $tc->matieuchi)->avg('diem');
                $classsd = $classsd + (($pl - $avgalllop) * ($pl - $avgalllop));
            }
            if($sllop != 0){
                 $classsd = sqrt($classsd/$sllop);
            }
            //cùng gv, khác môn
            $demlop = 0;
            $avggvlop = 0;
            foreach (LopMonHoc::where('giangvien' , $request->giangvien)->where('id', '!=', $request->lmhid)->cursor() as $class) {
                $avggvlop = $avggvlop + Diem::where('madiem', 'like', $class->id)->where('matieuchi', $tc->matieuchi)->avg('diem');
                $demlop++;
            }
            if($demlop != 0){
                $avggvlop = $avgalllop/$demlop;
            }

            $classgvsd = 0;
            foreach (LopMonHoc::where('giangvien' , $request->giangvien)->where('id', '!=', $request->lmhid)->cursor() as $class) {
                $pl = Diem::where('madiem', 'like', $class->id)->where('matieuchi', $tc->matieuchi)->avg('diem');
                $classgvsd = $classgvsd + (($pl - $avggvlop) * ($pl - $avggvlop));
            }
            if($demlop != 0){
                 $classgvsd = sqrt($classgvsd/$demlop);
            }


            array_push($dstc, array($tc->matieuchi, $tentc->tieuchi,(float) $tcavg, $tcsd, $avgalllop, $classsd, $avggvlop, $classgvsd));
        }
        return response() -> json([
                'svyes' => $svyes,
                'sv' => $slsv,
                'giangvien' => $giangvien->name,
                'dstc' => $dstc
            ], 200);
    } 


    /**
    * Hàm lấy thông tin lớp môn học đang khảo sát
    *
    * @param $request (id lớp môn học)
    *
    * @return json 
    */
    public function postLMHNoData(Request $request){
        $svyes = DsLMH::where('listid', $request->lmhid)->where('status', 'y')->count();
        $slsv = DsLMH::where('listid', $request->lmhid)->count();
        $dssv = array();
        $giangvien = GiangVien::where('gvid', $request->giangvien)->first();
        foreach (DsLMH::where('listid', $request->lmhid)->where('status', 'n')->cursor() as $id) {
            $info = SinhVien::where('svid', $id->masinhvien)->first();
            if($info != null){
                array_push($dssv, array($id->masinhvien, $info->name, $info->class));
            }else {
                array_push($dssv, array($id->masinhvien, 'no data', 'no data'));
            }
            
        }
        return response() -> json([
                'svyes' => $svyes,
                'sv' => $slsv,
                'giangvien' => $giangvien->name,
                'dssv' => $dssv
            ], 200);
    }
}

    




        

        
