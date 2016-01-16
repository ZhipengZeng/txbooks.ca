@extends('layouts/master')

@section('content')
<div class="container" id="content">
	<h2>{{ Auth::user()->username }}, you have {{ $count }} books posted</h2>
	@foreach($mybooks as $mybook)
		<p>
			<a href="{{ URL::route('deleteMyBook', array('id' => $mybook->id)) }}" ><span class="glyphicon glyphicon-remove"></span></a>
			<a href="{{ URL::route('book', array('id' => $mybook->id)) }}">{{ $mybook['title'] }}</a>
		</p>
	@endforeach
	
</div>
@endsection