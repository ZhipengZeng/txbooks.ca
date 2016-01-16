<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Program;
use App\School;
use App\Book;

class SidebarController extends Controller
{
    public function schoolClicked($id){
    	$schools = School::all();
    	$programs = Program::where('school_id', '=', $id)->get();
    	$books = Book::where('school_id', '=', $id)->get();
    	return view('home')->with('programs', $programs)->with('schools', $schools);
    }
}
