@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Jadwal')

@section('content')
    <div class="container">
        <h1>Jadwal</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
 
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="/jadwal/create" class="btn btn-outline-secondary btn-flat">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="text">Tambah Jadwal</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>UKM/HMJ</th>
                                <th>Hari</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tempat</th>
                                <th>Pelatih</th>
                                <th>Ketua Mahasiswa</th>
                                <th>Aksi</th>
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
                                @if (count(explode(',', $jadwal['pelatih_id'])) > 1)
                                    <td>
                                    @php
                                        $pelatih = App\Users::whereIn('id', explode(',', $jadwal['pelatih_id']))->get()
                                    @endphp
                                     @foreach ($pelatih as $item)
                                     <li>{{ $item->nama}}</li>
                                 @endforeach
                                    </td>
                                @else
                                    <td>{{ $jadwal['pelatih']}}</td>
                                @endif

                                <td>{{ $jadwal['ketuamhs'] }}</td>
                                <td>
                                    <a href="/jadwal/{{ $jadwal['id']}}/edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="/jadwal/{{ $jadwal['id']}}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection