<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .container{margin-top: 40px;}
        body {
            font-family: 'Varela Round', sans-serif;
        }
        .form-control {
            box-shadow: none;
            border-color: #ddd;
        }
        .form-control:focus {
            border-color: #FB6E9D;
            box-shadow: 0 0 8px rgba(251,110,157,0.4);
        }
        .login-form {
            color: #434343;
            width: 350px;
        }
        .login-form .login-content {
            padding: 20px;
            border-radius: 1px;
            border: none;
            position: relative;
        }
        .login-form .login-header {
            border-bottom: none;
        }
        .login-form h4 {
            text-align: center;
            font-size: 22px;
            margin-bottom: -10px;
        }
        .login-form .avatar {
            color: #fff;
            margin: 0 auto;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            z-index: 9;
            background: #FB6E9D;
            padding: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }
        .login-form .avatar i {
            font-size: 62px;
        }
        .login-form .form-control, .login-form .btn {
            min-height: 40px;
            border-radius: 1px;
            transition: all 0.5s;
        }
        .login-form {
            text-align: center;
            padding-top: 10px;
        }
        .login-form .close {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .login-form .btn {
            background: #FB6E9D;
            border: none;
            line-height: normal;
        }
        .login-form .btn:hover, .login-form .btn:focus {
            background: #fb3c7a;
        }
        .login-form .hint-text a {
            color: #999;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                    <!-- navbar-brand의 content 변경 -->
                    <a class="navbar-brand" href="#">CRYSTAL.PROJECT</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/admin">Admin <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
