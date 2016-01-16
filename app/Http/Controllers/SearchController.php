<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Validator;
use Input;
use App\Http\Controllers\Flash;
use Session;

class SearchController extends Controller
{
    public function search(Request $request){

        $validator = Validator::make($request->all(), [
            'search' => 'required|max:30|string',
        ]);

        if ($validator->fails()) {
            // notify()->flash($validator->errors()->first(),'warning');
            return view('home');
        }else{
            $input = $request->input('search');
            // $books = Book::where('title', 'like', "%$input%")->orderBy('updated_at', 'desc')->get();
            $books = Book::where('title', 'like', "%$input%")->orderBy('updated_at','desc')->paginate(3);
            return view('home')->with('books', $books);
            
        }
    }
    public function getBooks($id){
        // $books = Book::where('program_id', '=', $id)->orderBy('updated_at', 'desc')->get();
        $books = Book::where('program_id', '=', $id)->orderBy('updated_at','desc')->paginate(3);

        return view('home')->with('books', $books);
    }
}
