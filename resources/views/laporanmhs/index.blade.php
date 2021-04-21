@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan')

@section('content')
    <div class="container">
 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1>Laporan Keaktifan Mahasiswa</h1>
            </div>
            <div class="card-body p-2 m-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="list-group">
                            @foreach ($data as $date)
                                <a href="/laporanmhs/{{ $date->id_ukm }}/{{ $date->tahun }}/{{ $date->bulan }}" class="list-group-item list-group-item-action">
                                    {{ $date->nama_ukm }} | {{ $date->bulan }}/{{ $date->tahun }}
                                </a>                            
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto">
                        <center>
                        <img src="{{asset('assets/img/logo.png')}}" alt="" width="80%" class="align-middle">
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection