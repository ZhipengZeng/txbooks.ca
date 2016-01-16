@extends('layouts/master')

@section('content')
<div class="container" id="content">
	@if(isset($book))
	<div class="col-lg-4 left">
		<p><strong>Title: </strong>{{ $book['title'] }}</p>
		<p><strong>Description: </strong>{{ $book['description'] }}</p>
		<p><strong>Category: </strong>{{ $book['category'] }}</p>
		<p><strong>ISBN: </strong>{{ $book['isbn'] }}</p>
		<p><strong>Updated at: </strong>{{ $book['updated_at'] }}</p>
		
	</div>
	<div class="col-lg-6 right">
		<p><strong>Owner: </strong>{{ App\User::find($book['user_id'])->username }}</p>
		<p><strong>Owner Email: </strong>{{ App\User::find($book['user_id'])->email }}</p>
		<p><strong>School: </strong>{{ App\School::find($book['school_id'])->school_name }}</p>
		<p><strong>Program: </strong>{{ App\Program::find($book['program_id'])->program_name }}</p>
		<p><strong>Course: </strong>{{ App\Course::find($book['course_id'])->course_name }}</p>
	</div>
	@else
	<p>{{ $message }}</p>
	@endif
</div>
@endsection