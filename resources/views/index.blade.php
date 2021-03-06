@extends('layouts.main')

@section('title', 'SiMUDAH | Sistem Informasi MDP UKM dan HMJ')

@section('content')
    <div class="container">
        <div class="col-lg-7">
            <h1>Pengumuman</h1>
            
            @foreach($pengumuman as $pengumuman)
                <div class="card shadow m-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ $pengumuman->judul}} |
                            @if (!empty($pengumuman->ukm->nama_ukm))
                                    {{ $pengumuman->ukm->nama_ukm }}
                                @else
                                    Semua UKM/HMJ
                                @endif
                        </h4>
                        <p class="cart-text">{!! $pengumuman->isi !!}</p> 
                        <p class="card-text mb-2"><small class="text-muted">Diupload pada {{ $pengumuman->created_at}} oleh <strong>{{ $pengumuman->nama }}</strong></small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection