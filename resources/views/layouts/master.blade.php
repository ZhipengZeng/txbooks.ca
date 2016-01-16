<!-- views/layouts/master.blade.php -->
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title>txbooks.ca</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="HandheldFriendly" content="true">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ URL::asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ URL::asset('assets/css/master.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        @yield('style') <!-- leave a room for other views' stylesheet -->

    </head>

    <body>
        <header class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::route('home') }}">Txbooks.ca for Humber students</a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navHeaderCollapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li class="{{ URL::current() == url('/') || URL::current() == url('/home') ? "active" : '' }}">
                            <a class="nav_item" href="{{ URL::route('home') }}">Home</a> 
                        </li>

                        @if(Auth::guest())<!-- check the user status, logged in or not -->
                        <li class="{{ URL::current() == url('auth/register') ? "active" : '' }}">
                            <a class="nav_item" href="{{ URL::route('register') }}">Register</a>
                        </li>

                        <li class="{{ URL::current() == url('auth/login') ? "active" : '' }}">
                            <a class="nav_item" href="{{ URL::route('getLogin') }}">Login</a>
                        </li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }}
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav_item" href="{{ URL::route('getMyBooks') }}">My Books</a></li>
                                <li><a class="nav_item" href="{{ URL::route('book_create') }}">Post Books</a></li>
                                @if(Auth::user()->admin) <!-- check the user status, admin or not -->
                                    <li><a class="nav_item" href="{{ URL::route('admin') }}">Admin</a></li>
                                @endif
                                <li><a class="nav_item" href="{{ URL::route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </header>
        
        @include('layouts/search')
        <div class="container wrap">
            
            @yield('content')
                
        </div>

        @include('layouts/footer')
        @yield('script')
        
    </body>
</html>


