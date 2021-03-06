<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
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

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <!--CAROUSEL-->
        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            </ul>     
            <!-- The slideshow -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/carousel1.jpg') }}" alt="Gambar - 1" class="img-fluid" width="100%">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/carousel.jpg') }}" alt="Gambar - 2" class="img-fluid" width="100%">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/carousel2.jpg') }}" alt="Gambar - 3" class="img-fluid" width="100%">
            </div>
            </div>   
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <b>SiMUDAH</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/jadwal-ukm">Jadwal</a>
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
