<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            /* background: url(public/images/background-2.jpg) no-repeat center center fixed; */
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .log-form {
            width: 320px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, .25);
            padding: 20px;
        }

        .log-form h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .log-form input[type="text"],
        .log-form input[type="email"],
        /* Adjusted to target email input type */
        .log-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .log-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .log-form button[type="submit"]:hover {
            background-color: #343a40;
            ;
        }

        .log-form .forgot {
            text-align: right;
            font-size: 14px;
        }

        .log-form .forgot a {
            color: #343a40;
            text-decoration: none;
        }

        .log-form .forgot a:hover {
            color: #343a40;
            ;
        }

        .navbar-collapse {
            background-color: #f8f9fa;
            /* Set the background color */
            padding: 10px;
            /* Add some padding */
        }

        .navbar-nav {
            margin-left: auto;
            /* Push the nav items to the right */
        }

        .nav-item {
            margin-right: 15px;
            /* Add some space between nav items */
        }

        .nav-link {
            color: #333;
            /* Set the default color for nav links */
            font-weight: bold;
            /* Make the text bold */
        }

        .dropdown-menu {
            background-color: #f8f9fa;
            /* Set the background color for dropdown menu */
            border: none;
            /* Remove border */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Add shadow */
        }

        .nav-link {
            text-decoration: none;
            /* Remove text decoration */
        }

        .dropdown-item {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="log-form">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                {{-- <button class="" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <center> <a class="nav-link "my-list href="{{ route('login') }}">{{ __('Login..') }}</a>
                            </center>
                        @endif

                        {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                    @else
                        <center>
                            <h1> {{ Auth::user()->name }}
                            </h1>
                        </center>

                        <center>
                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </center>

                    @endguest

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
