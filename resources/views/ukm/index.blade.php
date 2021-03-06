@extends('layouts.mainadv')

@section('title', 'SiMUDAH | UKM/HMJ')

@section('content')
    <div class="container">
        <h1 class="ml-3">UKM/HMJ</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            @if (session('user')->role == 'adminaplikasi')
                <div class="card-header py-3">
                    <a href="{{ route('ukm.create') }}" class="btn btn-outline-secondary btn-flat">
                        <span class="text">Tambah UKM/HMJ</span>
                    </a>
                </div>    
            @else
                
            @endif
            
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama UKM/HMJ</th>
                                <th>Pembina</th>
                                <th>Pelatih</th>
                                <th>Ketua Mahasiswa</th>
                                <th>Status</th>
                                <th>Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ukm as $u)
                            <tr>
                                <td>{{ $u->nama_ukm }}</td>
                                <td>{{ $u->pembina->nama }}</td>
                                <td>{{ $u->pelatih->nama }}</td>
                                <td>{{ $u->ketuamhs->nama }}</td>
                                <td>{{ $u->status }}</td>
                                <td>
                                    <center><a href="/anggota/{{ $u->id }}">Lihat</i></a></center>
                                </td>
                                <td>
                                    <center>
                                    <a href="{{ route('ukm.edit',['ukm'=>$u->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('ukm.destroy',['ukm'=>$u->id]) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    </center>
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