<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Moogle Mafia</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/7f7e8931e5.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Trumbowyg/dist/ui/trumbowyg.min.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
</head>
<body>
<div id='container' class="margin-auto">
    <header>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm border-bottom border-secondary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('css/imgs/MoogleMafiaLogo.png') }}" alt="logo" class='header_logo'>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rules') }}">{{ __('Rules') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class='border-top border-secondary' id='footer'>
        copyright Spectral Requiem 2019
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}"></script>
<script src="{{ asset('js/wysiwyg.js') }}"></script>
<script src="{{ asset('slick/slick.min.js') }}"></script>
<script src="{{ asset('js/moogle.js') }}"></script>
</body>
</html>
