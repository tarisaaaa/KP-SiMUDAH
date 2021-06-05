@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Daftar Absensi Pelatih')

@section('content')

<div class="container">

    <div class="col-lg-10">

        <div class="card mx-auto">

            <div class="card-header">
                <h4 class="mt-4">
                    <strong>{{ session('user')->nama }}</strong>
                    <p>UKM {{ $data->nama_ukm }}</p>
                </h4>
            </div>

            <div class="card-body">
                
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Pertemuan ke-</th>
                            <th>Tanggal</th>
                            <th>Keterangan Latihan</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absen as $absensipelatih)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($absensipelatih->absensi->created_at)) }}</td>
                                <td>{!! $absensipelatih->absensi->keterangan !!}</td>
                                <td>{{ $absensipelatih->kehadiran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="card-footer">
                <div class="float-right">Persentase kehadiran: {{ round($persentase,2) }}%</div>
            </div>
    
        </div>
        
    </div>

</div>

@endsection