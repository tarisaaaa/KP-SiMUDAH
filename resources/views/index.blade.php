@extends('layouts.main')

@section('title', 'SiMUDAH | Sistem Informasi MDP UKM dan HMJ')

@section('content')


    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-7 left">

                <div class="card">

                    <!--CAROUSEL-->
                    <div id="demo" class="carousel slide" data-ride="carousel"">
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

                </div>

                {{-- <div class="row">
                    <div class="col-lg-6 ml-3 mt-4 mr-5">
                        <img src="{{ asset('assets/img/logomdp.png')}}" alt="logomdp" width="200px">
                        <ul class="list-unstyled mt-3">
                            <li>
                                <i class="fas fa-map-pin pr-4"></i>Jl. Rajawali 14, 30113 Palembang - Sumatera Selatan
                            </li>
                            <li>
                                <i class="fas fa-phone-alt pr-3 mt-3"></i>(0711) 376 400
                            </li>
                            <li>
                                <i class="fas fa-globe-asia pr-3 mt-3"></i><a href="https://mdp.ac.id/" class="text-reset text-decoration-none">mdp.ac.id</a>
                            </li>
                            <li>
                                <i class="fab fa-instagram-square pr-3 mt-3"></i><a href="http://instagram.com/mdp_campus/">@mdp_campus</a>
                            </li>
                        </ul>
                    </div>
                </div> --}}

            </div>

            <div class="col-lg-5 right">
                <center><h1>PENGUMUMAN</h1></center>
                
                @if (count($pengumuman) > 0)
                    
                    @foreach($pengumuman as $p)
                        <div class="card shadow m-4">
                            <div class="card-body">
                                <h4 class="card-title">{{ $p->judul}} |
                                    @if (!empty($p->ukm->nama_ukm))
                                        {{ $p->ukm->nama_ukm }}
                                    @else
                                        Semua UKM/HMJ
                                    @endif
                                </h4>
                                <p class="cart-text">{!! $p->isi !!}</p> 
                                <p class="card-text mb-2"><small class="text-muted">Diupload pada {{ date('d-m-Y H:i', strtotime($p->created_at)) }} WIB oleh <strong>{{ $p->nama }}</strong></small></p>
                            </div>
                        </div>
                    @endforeach

                    <div class="pagination justify-content-center">
                        {{ $pengumuman->render() }}
                    </div>
                @else
                    <div class="card m-4 p-4">
                        Belum ada pengumuman
                    </div>
                @endif
                
            </div>

        </div>
    </div>
@endsection