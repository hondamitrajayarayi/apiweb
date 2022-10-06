<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;

use Auth;

class TestController extends Controller
{
    
    // public function test(){
    // 	$users = DB::select('select* From vi_price_list_4');
    // 	var_dump($users);
    // 	return view('welcome', compact('users'));
    // }

    public function book() {
        $data = "Data All Book";
        return response()->json($data, 200);
    }

    public function bookAuth() {
        $data = "Welcome with Token";
        return response()->json($data, 200);
    }
}
