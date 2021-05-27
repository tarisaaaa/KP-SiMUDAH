@extends('layouts.mainadv')

@section('title', 'Profil Mahasiswa')

@section('content')
    <div class="container">
        <h1 class="ml-3 mb-3">Profil Ketua Mahasiswa</h1>

        <div class="col-lg-7">
            <div class="card card-outline card-maroon m-3">
                <div class="card-header">
                    <div class="card-title">
                        @if (!empty($ketuamhs->user_id))
                            <strong>{{ $ketuamhs->users->nama}}</strong>
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
                    @if (!empty($ketuamhs->user_id))
                        <p class="mb-0"><strong>Username</strong></p>
                        <p class="card-text">{{ $ketuamhs->users->user_name }}</p>
                        
                        <p class="mb-0"><strong>NIK/NPM</strong></p>
                        <p class="card-text">{{ $ketuamhs->niknpm }}</p>

                        <p class="mb-0"><strong>Email</strong></p>
                        <p class="card-text">{{ $ketuamhs->users->email }}</p>
                    
                        <p class="mb-0"><strong>Nomor HP</strong></p>
                        <p class="card-text">{{ $ketuamhs->nohp }}</p>

                        <p class="mb-0"><strong>Alamat</strong></p>
                        <p class="card-text">{{ $ketuamhs->alamat }}</p>                     
                    @endif
                    
                    <a href="/ketuamhs" class="card-link card-maroon">Kembali</a>
                </div>
            </div>

        </div>

    </div>
@endsection