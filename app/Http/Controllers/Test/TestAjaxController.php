<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Program;
use App\Course;
use App\School;

// 2 important components used here: Crawler and CssSelector
// install them through commands:
// composer require symfony/dom-crawler 
// composer require symfony/css-selector

class TestAjaxController extends Controller
{
	public function test(){
			$school_id = 1;
	      	$programs = Program::where('school_id', '=', $school_id)->get();
	      	$json_programs = json_encode($programs);
	      	return response()->json($programs);
	}
}
