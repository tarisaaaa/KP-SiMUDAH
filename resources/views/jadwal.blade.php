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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwal as $jadwal)
                            <tr>
                                <td>{{ $jadwal->ukm->nama_ukm }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->waktu_mulai }}</td>
                                <td>{{ $jadwal->waktu_selesai }}</td>
                                <td>{{ $jadwal->tempat }}</td>
                                <td>{{ $jadwal->pelatih->nama }}</td>
                                <td>{{ $jadwal->ketuamhs->nama }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection