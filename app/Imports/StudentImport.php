<?php

namespace App\Imports;

use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;

use App\SinhVien;

use App\users;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $row)
    {
    	$batdau = false;
    	foreach ($row as $rows) {
    		if($batdau == true){
    			if($rows[1] == ""){
    				$batdau = false;
    				break;
    			}else{
    				$check = users::where('username', trim($rows[1],'  '))->first();
    				if($check == null){
    					$user = new users;
	    				$user->username = trim($rows[1],'  ');
	    				$user->password = bcrypt(trim($rows[2],'  '));
	    				$user->type = 'student';
	    				$sinhvien = new SinhVien;
	    				$sinhvien->svid = trim($rows[1],'  ');
	    				$sinhvien->name = trim($rows[3],'  ');
	    				$sinhvien->email = trim($rows[1],'  ').'@vnu.edu.vn';
	    				$sinhvien->class = trim($rows[5],'  ');
	    				$user->save();
	    				$sinhvien->save();
    				}else {
    				}
    			}
    		}elseif ($rows[4] == 'VNU email') {
    			$batdau = true;
    		}
    	}
        

    }
}
