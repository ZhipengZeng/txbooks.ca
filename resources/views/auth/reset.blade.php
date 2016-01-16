<!-- resources/views/auth/reset.blade.php -->
<!-- for reset password -->
@extends('layouts/master')

@section('content')


    <div class="col-lg-6 col-lg-offset-3">
        <form method="POST" action="/password/reset" class="form-vertical">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <label for="email" class="hidden" >Email: </label>
                <input type="email" name="email" value="{{ old('email') }}"
                id="email" class="form-control" placeholder="example@example.com">
            </div>

            <div class="form-group">
                <label for="password" class="hidden" >Password: </label>
                <input type="password" name="password"
                id="password" class="form-control" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="confirm_password" class="hidden" >Confirm Password: </label>
                <input type="password" name="password_confirmation"
                id="confirm_password" class="form-control" placeholder="Confirm your password">
            </div>

            <div>
                <button type="submit" class="btn btn-default">
                    Reset Password
                </button>
            </div>
        </form>
    </div>

@endsection