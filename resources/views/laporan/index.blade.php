@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1>Laporan Pelatih Bulan {{ date('m Y') }}</h1>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>UKM</th>
                                <th>Pelatih</th>
                                <th>Jumlah Kegiatan</th>
                                <th>Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $laporan)
                                <td>{{ $laporan->nama_ukm }}</td>
                                <td>{{ $laporan->nama }}</td>
                                <td>{{ $laporan->jumlah_absensi }}</td>                        
                            @endforeach
                            <td><center><a href="/laporan/">Download</i></a></center></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection