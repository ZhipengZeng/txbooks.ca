@extends('layouts/master')

@section('content')

    <div class="container" id="content">
    <div class="col-lg-6 col-lg-offset-3">
    <h1>Dashboard</h1>
    
    @if($message != null)
    <p>{{ $message }}</p>
    @endif
    </div>
    </div>
@endsection
