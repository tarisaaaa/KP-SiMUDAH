@extends('layouts.mainadv')

@section('title', 'Profil Admin Aplikasi')

@section('content')
    <div class="container">
        <h1 class="ml-3 mb-3">Profil Admin Aplikasi</h1>

        <div class="col-lg-7">
            <div class="card card-outline card-pink m-3">
                <div class="card-header">
                    <div class="card-title">
                        @if (!empty($adminaplikasi->user_id))
                            <strong>{{ $adminaplikasi->users->nama}}</strong>
                        @else
                            <p class="card-text">Data profil belum diisi</p>
                        @endif
                    </div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if (!empty($adminaplikasi->user_id))
                        <p class="mb-0"><strong>Username</strong></p>
                        <p class="card-text">{{ $adminaplikasi->users->user_name }}</p>
                        
                        <p class="mb-0"><strong>NIK/NPM</strong></p>
                        <p class="card-text">{{ $adminaplikasi->niknpm }}</p>

                        <p class="mb-0"><strong>Email</strong></p>
                        <p class="card-text">{{ $adminaplikasi->users->email }}</p>
                    
                        <p class="mb-0"><strong>Nomor HP</strong></p>
                        <p class="card-text">{{ $adminaplikasi->nohp }}</p>

                        <p class="mb-0"><strong>Alamat</strong></p>
                        <p class="card-text">{{ $adminaplikasi->alamat }}</p>                     
                    @endif
                    
                    <a href="/adminaplikasi" class="card-link card-pink">Kembali</a>
                </div>
            </div>

        </div>

    </div>
@endsection