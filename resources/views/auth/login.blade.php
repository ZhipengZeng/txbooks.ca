<!-- resources/views/auth/login.blade.php -->
@extends('layouts/master')

@section('content')
<div class="container " id="content">
    <div class="col-lg-6 col-lg-offset-3">
        <h1>Login</h1>
        {!! Form::open(array('route' => 'postLogin', 'method' => 'post', 'class' => 'form-vertical', 'role' => 'form')) !!}
            {!! csrf_field() !!}
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
            {!! Form::checkbox('remember', 'RememberMe', null, ['id'=>'remember']) !!}
            {!! Form::label('remember', 'Remember Me') !!}
            </div>
            <div class="form-group">
            {!! Form::submit('Login',array('class'=>'btn btn-primary')) !!}
            
            <a class="btn btn-info pull-right social_icon" href="{{ URL::to('auth/login/twitter') }}"><i class="fa fa-twitter"></i></a>
            <!-- <a class="btn btn-info pull-right social_icon" href="{{ URL::to('auth/login/twitter') }}"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-info pull-right social_icon" href="{{ URL::to('auth/login/twitter') }}"><i class="fa fa-google"></i></a>
            <a class="btn btn-info pull-right social_icon" href="{{ URL::to('auth/login/twitter') }}"><i class="fa fa-github"></i></a> -->
            </div>
            <p><a class="btn btn-default col-lg-4" href="{{ URL::to('password/email') }}">Forgot you password?</a></p>
            <p><a class="btn btn-warning col-lg-4 pull-right" href="{{ URL::route('register') }}">Have not an account yet?</a></p>
        {!! Form::close() !!}
    </div>

</div>

@endsection