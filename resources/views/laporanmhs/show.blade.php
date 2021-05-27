@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan Mahasiswa')

@section('content')
    <div class="container">
        {{-- <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="300px"></center> --}}
        <div class="card ml-5 mr-5">
            <div class="card-header">
                <a href="/laporanmhs" class="btn btn-outline-dark btn-sm m-2 float-left">Kembali</a>
                <a href="/laporanmhs-pdf/{{ $id_ukm }}/{{ $tahun }}/{{ $bulan }}" class="btn btn-info btn-sm m-2 float-right">Export PDF</a>
            </div>
            <div class="card-body ml-3 mr-3">
                <h2><center>Laporan Kehadiran Mahasiswa</center></h2>
                <center><h5>Bulan {{ $bulan }} Tahun {{ $tahun }}</h5></center>
<<<<<<< HEAD
                <center><h5>UKM {{ $query2->nama_ukm }}</h5></center>
        
=======
                <center><h5>{{ $query2->nama_ukm }}</h5></center>
                
>>>>>>> tarisa3
                <table class="table table-bordered" id="dataTable">  

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th> 
                            <th>Jumlah Kehadiran</th>
                            <th>Persentase Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($query as $laporan)
                        <tr>
                            <td style="width: 30px; text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $laporan->nama_anggota }}</td>
                            <td>{{ $laporan->jumlah_absensi }}</td>
                            <td>
                            @php
                                $persen = ($laporan->jumlah_absensi / $query2->jumlah_latihan) * 100
                            @endphp
                            {{$persen}}%
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection