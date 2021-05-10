@extends('layouts.mainadv')

@section('title', 'Profil Wakil Rektor III')

@section('content')
    <div class="container">
        <h1 class="ml-3 mb-3">Profil Wakil Rektor III</h1>

        <div class="col-lg-7">
            <div class="card card-outline card-info m-3">
                <div class="card-header">
                    <div class="card-title">
                        @if (!empty($wk->user_id))
                            <strong>{{ $wk->users->nama}}</strong>
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
                    @if (!empty($wk->user_id))
                        <p class="mb-0"><strong>Username</strong></p>
                        <p class="card-text">{{ $wk->users->user_name }}</p>
                        
                        <p class="mb-0"><strong>NIK/NPM</strong></p>
                        <p class="card-text">{{ $wk->niknpm }}</p>

                        <p class="mb-0"><strong>Email</strong></p>
                        <p class="card-text">{{ $wk->email }}</p>
                    
                        <p class="mb-0"><strong>Nomor HP</strong></p>
                        <p class="card-text">{{ $wk->nohp }}</p>

                        <p class="mb-0"><strong>Alamat</strong></p>
                        <p class="card-text">{{ $wk->alamat }}</p>                     
                    @endif
                    
                    <a href="/wk" class="card-link card-info">Kembali</a>
                </div>
            </div>

        </div>

    </div>
@endsection