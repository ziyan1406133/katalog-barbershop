<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('light-dashboard/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('light-dashboard/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            @include('layouts.navbar')
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="https://www.facebook.com/sttgarut/?rf=116264051720545">
                                    <span class="fa fa-facebook"></span>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/stt_garut?lang=en">
                                    <span class="fa fa-twitter"></span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/sttgarut/?hl=en">
                                    <span class="fa fa-instagram"></span>
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            Sekola Tinggi Teknologi Garut © 2019 | Tema dibuat Oleh
                            <a href="http://www.creative-tim.com">Creative Tim</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="{{ asset('light-dashboard/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('light-dashboard/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('light-dashboard/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('light-dashboard/js/light-bootstrap-dashboard.js?v=2.0.0') }}"></script>
    @yield('script')
    
</body>
</html>
