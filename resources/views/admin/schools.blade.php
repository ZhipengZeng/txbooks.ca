<!-- for adding school by admin -->
@extends('layouts/master')

@section('content')
    <div class="container " id="content">
    <div class="col-lg-6 col-lg-offset-3">
        <h1>Admin Panel - Schools</h1>
        <form method="POST" action="{{ URL::to('admin/schools') }}" class="form-vertical">
            {!! csrf_field() !!}

            <table class="table table-striped">
            @foreach($schools as $school)
            	<tr>
                    <td><a href="{{ URL::to('admin/schools/delete/' . $school->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a href="{{ URL::to('admin/schools/delete/' . $school->id) }}" ><span class="glyphicon glyphicon-remove"></span></a></td>
                    <!-- <td><input class="form-control" type="text" value="{{ $school->school_name }}"></td> -->
                    <td>{{ $school->school_name }}</td>
                </tr>
            @endforeach
            </table>

            <div class="form-group">
                @if ($errors->has('school'))
                <p class="text-danger">{{ $errors->first('school', ':message') }}</p>
                @endif
                {!! Form::label('school', 'School: ', array('class' => 'hidden')) !!}
                {!! Form::text('school', old('school'), 
                    array('class' => 'form-control','placeholder' => 'Input New School Name')) !!}
                
            </div>

            <div>
                <input type="submit" class="btn btn-primary" value="Add">
                <a href="{{ URL::to('admin') }}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
    </div>
    
@endsection
