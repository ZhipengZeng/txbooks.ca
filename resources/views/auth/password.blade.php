<!-- resources/views/auth/password.blade.php -->
@extends('layouts/master')

@section('content')

    <div class="container" id="content">
    <div class="col-lg-6 col-lg-offset-3">
        <form method="POST" action="/password/email" class="form-vertical">
            {!! csrf_field() !!}

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

            <div>
                <button type="submit" class="btn btn-default">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
    </div>
@endsection