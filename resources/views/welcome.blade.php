<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/home.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a13157347a.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <style>
        body{
            background: #010103;
        }
        nav{
            font-size:17px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm pt-3 pb-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-home fa-lg"></i></a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="body">
            <section class="home" id="home">
                <div class="content">
                    <h3>Welcome</h3>
                    <p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</strong></p>
                    @auth
                    <a href="{{ route('companies.index') }}" class="btn btn-success" style="font-size: 1.2rem;">See Company</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-success" style="font-size: 1.2rem;">See Company</a>
                    @endauth
                </div>
            </section>

            <section class="about" id="about">
                <h1 class="heading"><span>About</span> Us</h1>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <div class="image">
                                <img src="{{ url('images/about.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="content">
                            <h3>lorem ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                laboris nisi ut aliquip ex ea commodo consequat.<br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                                labore et dolore magna aliqua.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="footer" id="footer">
            <div class="share">
                <a href="" class="fab fa-instagram"></a>
                <a href="" class="fab fa-facebook"></a>
                <a href="" class="fab fa-twitter"></a>
                <a href="" class="fab fa-youtube"></a>
                <a href="" class="fab fa-pinterest"></a>
            </div>

            <div class="links">
                <a href="">Login</a>
                <a href="">Register</a>
            </div>

            <div class="credit">
                created by <span>Aqidatul Izza</span> | all rights reserved
            </div>
        </section>
    </div>
</body>
</html>