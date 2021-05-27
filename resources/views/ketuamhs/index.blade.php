@extends('layouts.mainadv')

@section('title', 'MDP UKM | Ketua Mahasiswa')

@section('content')
    <div class="container">
        <h1 class="ml-3">Ketua Mahasiswa</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/ketuamhs/create" class="btn btn-outline-secondary btn-flat">
                    <span class="text">Tambah Ketua Mahasiswa</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $mhs)
                            <tr>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->user_name }}</td>
                                <td>{{ $mhs->email }}</td>
                                <td>
                                    <a href="/ketuamhs/{{ $mhs->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('ketuamhs.edit',['ketuamh'=>$mhs->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('ketuamhs.destroy',['ketuamh'=>$mhs->id]) }}" method="POST" class="d-inline">
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