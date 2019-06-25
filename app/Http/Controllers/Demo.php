<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

class Demo extends Controller
{
	public function post(Request $request){
        return response() -> json([
                'message' => 'Nice'
            ], 200);
    }
}