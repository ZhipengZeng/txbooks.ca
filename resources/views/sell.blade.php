@extends('layouts/master')

@section('content')

	<div class="container" id="content">
    

    <div class="col-lg-4">
    <h3 class="text-left">My Books: <a href="{{ URL::route('getMyBooks') }}">{{ $count }}</a></h3>

    @if(isset($mybooks))
        @foreach($mybooks as $mybook)
            <p><a href="{{ URL::route('book', array('id' => $mybook->id)) }}">{{ $mybook['title'] }}</a></p>
        @endforeach
    @else
        <p>You have no books yet</p>
    @endif


    </div> 



    {!! Form::open(array('route' => 'book_create', 'method' => 'post', 'class' => 'form-vertical col-lg-6', 'role' => 'form', 'id' => 'create', 'name' => 'create')) !!}
    <h1 class="text-center">Post A Book</h1>
    <div class="form-group">
        @if ($errors->has('title'))
            <p class="text-danger">{{ $errors->first('title', ':message') }}</p>
        @endif
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', old('title'), ['class'=>'form-control', 'id'=>'title']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('isbn', 'ISBN:') !!}
        {!! Form::text('isbn', old('isbn'),['class'=>'form-control', 'id'=>'isbn']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::text('description', old('description'),['class'=>'form-control', 'id'=>'description']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category', 'Category:') !!}
        {!! Form::text('category', old('category'),['class'=>'form-control', 'id'=>'category']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('school', 'School:') !!}
        <select id="school" class="form-control" name="school"></select>
    </div>
    <div class="form-group">
        {!! Form::label('program', 'Program:') !!}
        <select id="program" class="form-control" name="program"></select>
    </div>
    <div class="form-group">
        {!! Form::label('course', 'Course:') !!}
        <select id="course" class="form-control" name="course"></select>
    </div>
    <div class="form-group col-lg-6" style="padding-left: 0 !important;">
        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control', 'id' => 'submit']) !!}
    </div>
    <div class="form-group col-lg-6" style="padding-right: 0 !important;">
        {!! Form::reset('Reset', ['class' => 'btn btn-primary form-control', 'id' => 'reset']) !!}
    </div>
    {!! Form::close() !!}
    </div>
@endsection

@section('script')
	@include('js/ajax')
@endsection