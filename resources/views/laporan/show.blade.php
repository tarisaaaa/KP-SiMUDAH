@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan Pelatih')

@section('content')
    <div class="container">
        <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="300px"></center>
        <div class="card ml-5 mr-5">
            <div class="card-header">
                <a href="/laporan" class="btn btn-outline-dark btn-sm m-2 float-left">Kembali</a>
                <a href="/laporan-pdf/{{ $tahun }}/{{ $bulan }}" class="btn btn-info btn-sm m-2 float-right">Export PDF</a>
            </div>
            <div class="card-body ml-3 mr-3">
                
                <h2><center>Laporan Kehadiran Pelatih</center></h2>
                <center><h5>Bulan {{ $bulan }} Tahun {{ $tahun }}</h5></center>
                
                <table class="table table-bordered">  
                    <thead>
                        <th>UKM</th>
                        <th>Nama Pelatih</th>
                        <th>Jumlah Kehadiran</th>
                        <th>Total Latihan</th>
                    </thead>
                    <tbody>
                        @foreach ($results as $laporan)
                        <tr>
                            <td>{{ $laporan['nama_ukm'] }}</td>
                            <td>{{ $laporan['nama'] }}</td>
                            <td>{{ $laporan['jumlah_absensi'] }}</td>
                            <td>{{ $laporan['jumlah_latihan'] }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection