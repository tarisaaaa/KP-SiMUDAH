@extends('layouts.mainadv')

@section('title', 'MDP UKM | Absensi')

@section('content')
    <div class="container">
        <h1 class="ml-3">Absensi {{ $ukm->nama_ukm }}</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/absensi/create/{{$ukm->id}}" class="btn btn-outline-secondary btn-flat">
                    <span class="text">Tambah Absensi</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal/Waktu</th>
                                <th>Jumlah Kehadiran</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($results as $a)
                            <tr>
                                <td>{{ $a["created_at"] }}</td>
                                <td>{{ $a["jumlah_hadir"] }}</td>
                                
                                <td>{!! $a["keterangan"] !!}</td>
                                <td>
                                    @if(file_exists( public_path()."/assets/img/fotolatihan/".$a["foto"]))
                                        <img src="{{ asset('assets/img/fotolatihan/'.$a["foto"]) }}" width="100px" class="img-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    
                                    <form action="/absensi/{{ $a["id"] }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
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