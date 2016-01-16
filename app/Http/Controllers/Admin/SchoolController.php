<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use Validator;
use Input;
use Redirect;

class SchoolController extends Controller
{
    public function getIndex(){
    	$schools = School::all();
    	return view('admin\schools')->with('schools', $schools);
    }

    public function postAdd(Request $request){
    	$rules = [
            'school' => 'required'
        ];
        $input = Input::only(
            'school'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $school = new School;

        $school->school_name = $request->school;

        $school->save();

        $schools = School::all();

        return redirect()->route('schools')->with('schools', $schools);

    }
    public function getDelete($id){
    	$school = School::where(['id'=>$id])->first()->delete();
    	return Redirect::back();
    }
}
