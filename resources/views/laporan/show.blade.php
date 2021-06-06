@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Laporan Pelatih')

@section('content')
    <div class="container">
        {{-- <center><img src="{{ asset('/assets/img/logolaporan.png')}}" alt="laporan" width="300px"></center> --}}
        <div class="card ml-5 mr-5">
            <div class="card-header">
                <a href="/laporan" class="btn btn-outline-dark btn-sm m-2 float-left">Kembali</a>
                <a href="/laporan-pdf/{{ $date1 }}/{{ $date2 }}" target="_blank" class="btn btn-info btn-sm m-2 float-right">Export PDF</a>
            </div>
            <div class="card-body ml-3 mr-3">
                
                <h2><center>Laporan Kehadiran Pelatih</center></h2>
                <center><h5>{{ Carbon\Carbon::parse($date1)->isoFormat('Do MMMM Y') }} - {{ Carbon\Carbon::parse($date2)->isoFormat('Do MMMM Y') }}</h5></center>
                
                <table class="table table-bordered" id="dataTable">  
                    <thead>
                        <th>UKM</th>
                        <th>Nama Pelatih</th>
                        <th>Jumlah Kehadiran</th>
                        <th>Total Latihan</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $laporan)
                        <tr>
                            <td>{{ $laporan->nama_ukm }}</td>
                            <td>{{ $laporan->nama }}</td>
                            <td>{{ $laporan->jumlah_absensi }}</td>
                            <td>
                                @php
                                    $latihan = App\Absensi::where('ukm_id', $laporan->ukm_id)->whereBetween('created_at', [$date1, $date2])->count();
                                @endphp
                                {{ $latihan }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection