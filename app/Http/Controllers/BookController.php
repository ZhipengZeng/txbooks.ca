<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use Validator;
use Redirect;
use App\Book;
use App\School;
use App\Program;
use App\Course;

class BookController extends Controller
{
    public function deleteMyBook($id){
        if(Auth::check()){
            $book = Book::where(['id'=>$id])->first()->delete();
            return Redirect::back();
        }else{
            return redirect()->route('getLogin');
        }
    }
    public function getMyBooks(){
        if(Auth::check()){
            $user = Auth::user();
            $mybooks = Book::where('user_id', '=', $user->id )->orderBy('updated_at', 'desc')->get();
            $count = Book::where('user_id', '=', $user->id )->count();
            return view('mybooks')->with('mybooks', $mybooks)->with('count', $count);
        }else{
            return redirect()->route('getLogin');
        }
    }
    public function getBook($id){
        $book = Book::find($id);
        if($book == null){

            return view('book')->with('message', 'Sorry, book not found.');
        }
        return view('book')->with('book', $book);
    }

    public function create(){
    	if(Auth::check()){

            $user = Auth::user();
            $count = Book::where('user_id', '=', $user->id )->count();
            $mybooks = Book::where('user_id', '=', $user->id )->orderBy('updated_at', 'desc')->take(10)->get();

    		return view('sell')->with('mybooks', $mybooks)->with('count', $count);
    	}else{
    		return redirect()->route('getLogin');
    	}
    	
    }
    public function store(Request $request){

        $user_id = Auth::user()->id;

        $rules = [
            'title' => 'required',
            'school' => 'required|integer',
            'program' => 'required|integer',
            'course' => 'required|integer'
        ];

        $input = Input::only(
            'title',
            'school',
            'program',
            'course'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }


    	$book = new Book;

        $book->title = $request->input('title');
        $book->isbn = $request->input('isbn');
        $book->description = $request->input('description');
        $book->category = $request->input('category');
        $book->school_id = $request->input('school');
        $book->program_id = $request->input('program');
        $book->course_id = $request->input('course');
        $book->user_id = $user_id;

        $book->save();

		return redirect()->route('book_create');
    }
    public function ajaxGetSchools(Request $request){
        // if(Request::ajax()) {
            $schools = School::all();
            $schools_array = array();
            foreach ($schools as $key => $value) {
                $schools_array[] = $value;
            }
            return response()->json($schools_array);
        // }
    }
    public function ajaxGetPrograms(Request $request){
    	// if(Request::ajax()) {
	      	$school_id = $request->input('school_id');
	      	$programs = Program::where('school_id', '=', $school_id)->orderBy('program_name')->get();
	      	$programs_array = array();
	      	foreach ($programs as $key => $value) {
	      		$programs_array[] = $value;
	      	}
	      	return response()->json($programs_array);
	    // }
    }
    public function ajaxGetCourses(Request $request){
        // if(Request::ajax()) {
            $program_id = $request->input('program_id');
            $courses = Course::where('program_id', '=', $program_id)->orderBy('course_name')->get();
            $courses_array = array();
            foreach ($courses as $key => $value) {
                $courses_array[] = $value;
            }
            return response()->json($courses_array);
            // return back()->with('eee', $courses);
        // }
    }
}
