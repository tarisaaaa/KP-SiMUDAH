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
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>UKM/HMJ</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $date)
                                    <tr>
                                        <td>{{ $date->nama_ukm }}</td>
                                        <td>{{ $date->bulan }}</td>
                                        <td>{{ $date->tahun }}</td>
                                        <td><center><a href="/laporanmhs/{{ $date->id_ukm }}/{{ $date->tahun }}/{{ $date->bulan }}">Lihat</a></center></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 my-auto">
                        <center>
                        <img src="{{asset('assets/img/logo.png')}}" alt="" width="80%" class="align-middle">
                    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection