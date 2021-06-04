@extends('layouts.main')

@section('title', 'SiMUDAH | Buku Panduan')

@section('content')

<div class="container">
 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1>Buku Panduan Aplikasi SiMUDAH</h1>
        </div>

        <div class="card-body p-2 m-3">
            <div class="row">
                <div class="col-lg-6 my-auto">
                    <center>
                        <img src="{{asset('assets/img/logo.png')}}" alt="" width="80%" class="align-middle">
                    </center>
                </div>

                <div class="col-lg-6">
                    <div class="list-group">
                        <a href="/bukupanduan-adminaplikasi" class="list-group-item list-group-item-action">
                            Admin Aplikasi
                        </a>        
                        <a href="/bukupanduan-adminkeuangan" class="list-group-item list-group-item-action">
                            Admin Keuangan
                        </a> 
                        <a href="/bukupanduan-ketuamahasiswa" class="list-group-item list-group-item-action">
                            Ketua Mahasiswa
                        </a> 
                        <a href="/bukupanduan-pelatih" class="list-group-item list-group-item-action">
                            Pelatih
                        </a> 
                        <a href="/bukupanduan-pembina" class="list-group-item list-group-item-action">
                            Pembina
                        </a> 
                        <a href="/bukupanduan-wakilrektoriii" class="list-group-item list-group-item-action">
                            Wakil Rektor III
                        </a> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection