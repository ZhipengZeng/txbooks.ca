<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\School;
use App\Book;

class HomeController extends Controller
{
    public function index(){
    	
    	// $books = Book::orderBy('updated_at','desc')->take(20)->get();
    	$books = Book::orderBy('updated_at','desc')->paginate(3);
    	return view('home')->with('books', $books);
    }
}
