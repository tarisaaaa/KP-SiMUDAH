@extends('layouts.mainadv')

@section('title', 'SiMUDAH| Absensi')

@section('content')
    <div class="container">
        <h1 class="ml-3">List UKM</h1>

        <div class="col-lg-4">
        <div class="list-group">
            @foreach ($absensi as $absen)
                <a href="{{ route('absensi.show',['absensi'=>$absen->id]) }}" class="list-group-item list-group-item-action">{{ $absen->nama_ukm }}</a>
            @endforeach
          </div>
        </div>
    </div>
@endsection