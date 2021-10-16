@extends('layouts.mainadv')

@section('title', 'Pengumuman')

@section('content')
    <div class="container">
        @if (!empty($pengumuman->ukm->nama_ukm))
            <h1 class="ml-3 mb-3">{{ $pengumuman->ukm->nama_ukm}}</h1>
        @else
            <h1 class="ml-3 mb-3">Semua UKM/HMJ</h1>
        @endif

        <div class="col-lg-7">
            <div class="card card-outline card-info m-3">
                
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $pengumuman->judul }}</h5>
                    <p class="card-text">{!! $pengumuman->isi !!}</p>

                    <a href="/pengumuman" class="btn btn-info btn-sm">Kembali</a>
                </div>
            </div>

        </div>

    </div>
@endsection