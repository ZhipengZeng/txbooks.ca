<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function getIndex(){
    	// if(!Auth::user()->admin){
    	// 	return redirect()->route('home');
    	// }
    	return view('admin\admin');
    }

}
