@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Daftar Absensi Pelatih')

@section('content')
    <div class="container">
        
        <h1 class="ml-3">List UKM</h1>

        <div class="col-lg-4">
        <div class="list-group">
            @foreach ($listukm as $ukm)
                <a href="/daftarabsensipelatih/{{$ukm->id}}" class="list-group-item list-group-item-action">{{ $ukm->nama_ukm }}</a>
            @endforeach
          </div>
        </div>
    </div>
@endsection