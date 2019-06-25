<?php

namespace App\Imports;


use App\GiangVien;

use App\users;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LecturersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row){

    	$batdau = false;
    	foreach ($row as $rows) {
    		if($batdau == true){
    			if($rows[1] == ""){
    				$batdau = false;
    				break;
    			}else{
    				$check = users::where('username', trim($rows[1],'  '))->first();
    				if ($check == null){
    					$user = new users;
	    				$user->username = trim($rows[1],'  ');
	    				$user->password = bcrypt(trim($rows[2],'  '));
	    				$user->type = 'lecturers';
	    				$giangvien = new GiangVien;
	    				$giangvien->gvid = trim($rows[1],'  ');
	    				$giangvien->name = trim($rows[3],'  ');
	    				$giangvien->email = trim($rows[1],'  ').'@vnu.edu.vn';
	    				$user->save();
	    				$giangvien->save();
    				}else {
    				}
    			}
    		}elseif ($rows[4] == 'VNU email') {
    			$batdau = true;
    		}
    	}
        
    }
}
