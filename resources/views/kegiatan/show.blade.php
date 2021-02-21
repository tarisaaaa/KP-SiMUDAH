@extends('layouts.mainadv')

@section('title', 'Kegiatan')

@section('content')
    <div class="container">
        <h1 class="ml-3 mb-3">{{ $kegiatan->nama_kegiatan }}</h1>

        <div class="col-lg-7">
            <div class="card card-outline card-info m-3">
                
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $kegiatan->tanggal }}</h5>
                    <p class="card-text">{!! nl2br(e($kegiatan->keterangan)) !!}</p>

                    <a href="/kegiatan" class="btn btn-info btn-sm">Kembali</a>
                </div>
            </div>

        </div>

    </div>
@endsection