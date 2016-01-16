@extends('layouts/master')

             
    
@section('content')
	<div class="container col-lg-3 sidebar " id="content">
	@include('layouts/sidebar')  
	</div>

    <div class="container col-lg-9 main" id="content">

    <p><a href="{{ URL::route('book_create') }}" class="btn btn-info col-lg-12">I want to share/sell books</a></p>
    
    @if(isset($books))
      <div class="book_wrap col-lg-12">
      @if(count($books) == 0)
        <p class="col-lg-6">Sorry, no relative books found.</p>
        @if(Input::get('search') != null)
        <p class="col-lg-6 pull-right text-right"><strong>Keyword: </strong>{{ Input::get('search') }}</p>
        @endif
      @endif
      @foreach($books as $book)
      
        <div class="book_list col-lg-12">
        <!-- <p class="col-lg-6"><a href="{{ URL::route('book', array('id' => $book['id'])) }}">{{ $book['title'] }}</a></p>
        <p class="col-lg-3 text-right">Owner: {{ App\User::find($book['user_id'])->username }}</p>
        <p class="col-lg-3 text-right">{{ $book['updated_at'] }}</p> -->
        <p class="col-lg-6"><a href="{{ URL::route('book', array('id' => $book->id)) }}">{{ $book->title }}</a></p>
        <p class="col-lg-3 text-right">Owner: {{ App\User::find($book->user_id)->username }}</p>
        <p class="col-lg-3 text-right">{{ $book->updated_at }}</p>
        </div>
      @endforeach
    	</div>
   	@else
   		@if(isset($message))

   			<p>{{ $message }}</p>
   		
   		@endif
    @endif
    @if(isset($books))
    <div class="text-center"> {!! $books->appends(Request::all())->render() !!}</div>
    @endif
    </div>
    
@endsection


@section('style')
  @include('css/home')
@endsection