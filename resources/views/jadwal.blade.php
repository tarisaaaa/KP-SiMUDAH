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

                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $item->ukm->nama_ukm }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->waktu_mulai }}</td>
                                    <td>{{ $item->waktu_selesai }}</td>
                                    <td>{{ $item->tempat }}</td>
                                    @if (empty($item->ukm->pelatih->nama))
                                        <td>-</td>
                                    @else
                                        @if (count(explode(',', $item->ukm->pelatih_id)) > 1)
                                            <td>
                                                @php
                                                    $pelatih = App\Users::whereIn('id', explode(',', $item->ukm->pelatih_id))->get()
                                                @endphp
                                                @foreach ($pelatih as $p)
                                                    <li>{{ $p->nama}}</li>
                                                @endforeach
                                            </td>
                                        @else
                                            <td>{{ $item->ukm->pelatih->nama }}</td> 
                                        @endif
                                    @endif
                                    <td>{{ $item->ukm->ketuamhs->nama }}</td>
                                    @if (empty($item->ukm->pembina->nama))
                                        <td>-</td>
                                    @else
                                        <td>{{ $item->ukm->pembina->nama }}</td>
                                    @endif
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection