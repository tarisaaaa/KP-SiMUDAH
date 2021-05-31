@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Anggota')

@section('content')
    <div class="container">
        <h1 class="ml-3">List Anggota Aktif {{ $ukm->nama_ukm }}</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/anggota/create/{{$ukm->id}}" class="btn btn-outline-secondary btn-flat">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="text"> Tambah Anggota</span>
                </a>
                <a href="/anggota/{{ $ukm->id }}/showall" class="btn btn-default btn-flat float-right">Lihat Semua Anggota</a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>NPM</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($anggota as $a)
                            <tr>
                                <td>{{ $a->nama_anggota }}</td>
                                <td>{{ $a->npm }}</td>
                                <td>{{ $a->nohp }}</td>
                                <td>{{ $a->email }}</td>
                                <td>
                                    
                                    <a href="{{ route('anggota.edit',['anggotum' => $a->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="/anggota/{{ $a->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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