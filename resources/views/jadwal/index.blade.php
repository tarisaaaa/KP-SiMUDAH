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
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Nama Pelatih</th>
                                <th>Ketua Mahasiswa</th>
                                <th>Pembina</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ $item->ukm->nama_ukm }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ date('H.i', strtotime($item->waktu_mulai)) }} - {{ date('H.i', strtotime($item->waktu_selesai)) }}</td>
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
                                <td>
                                    <a href="/jadwal/{{ $item->id}}/edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="/jadwal/{{ $item->id}}" method="POST" class="d-inline">
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