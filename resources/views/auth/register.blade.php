<!-- for user registration -->
@extends('layouts/master')

@section('content')
	<div class="container" id="content">
    
    <div class="col-lg-6 col-lg-offset-3">

	    <h1>Register</h1>

		{!! Form::open(array('url' => 'auth/register', 'method' => 'post')) !!}
		
		    {!! csrf_field() !!}

			<div class="form-group">
			    @if ($errors->has('username'))
			    <p class="text-danger">{{ $errors->first('username', ':message') }}</p>
			    @endif
			    {!! Form::label('username', 'Username: ', array('class' => 'hidden')) !!}
			    {!! Form::text('username', old('username'), 
			        array('class' => 'form-control','placeholder' => 'Your username')) !!}
		    </div>

		    <div class="form-group">
			    @if ($errors->has('email'))
			    <p class="text-danger">{{ $errors->first('email', ':message') }}</p>
			    @endif
			    {!! Form::label('email', 'E-Mail: ', array('class' => 'hidden')) !!}
			    {!! Form::email('email', old('email'), 
			        array('class' => 'form-control','placeholder' => 'example@example.com')) !!}
		    </div>
		    
		    <div class="form-group">
			    @if ($errors->has('password'))
			    <p class="text-danger">{{ $errors->first('password', ':message') }}</p>
			    @endif    
			    {!! Form::label('password', 'Password: ', array('class' => 'hidden')) !!}
			    {!! Form::password('password',  
			        array('class' => 'form-control','placeholder' => 'Password')) !!}
		    </div>
		        
		    <div class="form-group">
			    {!! Form::label('password_confirmation', 'Confirm Password: ', array('class' => 'hidden')) !!}
			    {!! Form::password('password_confirmation',  
			        array('class' => 'form-control','placeholder' => 'Confirm Password')) !!}
		    </div>
		        
		    {!! Form::submit('Register',array('class'=>'btn btn-primary')) !!}
		    <a class="btn btn-warning col-lg-4 pull-right" href="{{ URL::route('getLogin') }}">Have an account already</a>
		{!! Form::close() !!}

	</div>
    
    </div>
    
    
@endsection