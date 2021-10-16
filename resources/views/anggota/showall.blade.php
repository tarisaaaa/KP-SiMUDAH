@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Anggota')

@section('content')
    <div class="container">
        

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header mt-2"><h3 class="ml-3">List Anggota {{ $ukm->nama_ukm }}</h3></div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>NPM</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($anggota as $a)
                            <tr>
                                <td>{{ $a->nama_anggota }}</td>
                                <td>{{ $a->npm }}</td>
                                <td>{{ $a->nohp }}</td>
                                <td>{{ $a->email }}</td>
                                <td>{{ $a->status }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="/anggota/{{$ukm->id}}" class="btn btn-sm btn-secondary ml-4">Kembali</a>
        
    </div>
@endsection