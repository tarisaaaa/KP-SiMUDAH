@extends('layouts.mainadv')

@section('title', 'MDP UKM | Pengumuman')

@section('content')
    <div class="container">
        <h1 class="ml-3">Pengumuman</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/pengumuman/create" class="btn btn-outline-secondary btn-flat">
                    <span class="text">Tambah Pengumuman</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>UKM/HMJ</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Pengupload</th>
                                <th>Waktu Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengumuman as $pengumuman)
                            <tr>
                                @if (!empty($pengumuman->ukm->nama_ukm))
                                    <td>{{ $pengumuman->ukm->nama_ukm }}</td>
                                @else
                                    <td>Semua UKM/HMJ</td>
                                @endif
                                
                                <td>{{ $pengumuman->judul }}</td>
                                <td>{{ substr($pengumuman->isi,0,20) }} ...</td>
                                <td>{{ $pengumuman->nama }}</td>
                                <td>{{ $pengumuman->created_at }}</td>
                                <td>
                                    <a href="/pengumuman/{{ $pengumuman->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('pengumuman.edit',['pengumuman'=>$pengumuman->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('pengumuman.destroy',['pengumuman'=>$pengumuman->id]) }}" method="POST" class="d-inline">
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