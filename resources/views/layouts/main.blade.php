<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico' )}}" type="image/x-icon">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<style>
    html, body {
        height: 100%;
    }
</style>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/icon2white.png') }}" alt="SiMUDAH Logo" width="90px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/jadwal-ukm">Jadwal</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/bukupanduan">Buku Panduan</a>
                        </li>
                    </ul>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        

        

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        // navbar scroll down
        $(document).ready(function () {
            var menu = $('.navbar');
            var origOffsetY = menu.offset().top;

            function scroll() {
                if ($(window).scrollTop() >= origOffsetY) {
                    $(menu).addClass('fixed-top');
                } else {
                    $(menu).removeClass('fixed-top');
                }
            }
            document.onscroll = scroll;
        });
    </script>
    <script>
        $(function () {
          $("#dataTable").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
    </script>
</body>
</html>
