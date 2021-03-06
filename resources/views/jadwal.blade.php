@extends('layouts.main')

@section('title', 'MDP UKM | Jadwal')

@section('content')
    <div class="container">
        
        <div class="card shadow mb-4">
            <div class="card-header">
                <h4><center><b>JADWAL LATIHAN</b></center></h4>
            </div>
            <div class="card-body m-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>UKM/HMJ</th>
                                <th>Hari</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tempat</th>
                                <th>Nama Pelatih</th>
                                <th>Ketua Mahasiswa</th>
                                <th>Pembina</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $jadwal)
                            <tr>
                                <td>{{ $jadwal['nama_ukm'] }}</td>
                                <td>{{ $jadwal['hari'] }}</td>
                                <td>{{ $jadwal['waktu_mulai'] }}</td>
                                <td>{{ $jadwal['waktu_selesai'] }}</td>
                                <td>{{ $jadwal['tempat'] }}</td>
                                <td>{{ $jadwal['pelatih']}}</td>
                                <td>{{ $jadwal['ketuamhs'] }}</td>
                                <td>{{ $jadwal['pembina'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection