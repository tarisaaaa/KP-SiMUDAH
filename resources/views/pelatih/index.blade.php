@extends('layouts.mainadv')

@section('title', 'MDP UKM | Pelatih')

@section('content')
    <div class="container">
        <h1 class="ml-3">Pelatih</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/pelatih/create" class="btn btn-outline-secondary btn-flat">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>Tambah Pelatih</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Pelatih</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $pelatih)
                            <tr>
                                <td>{{ $pelatih->nama }}</td>
                                <td>{{ $pelatih->user_name }}</td>
                                <td>{{ $pelatih->email }}</td>
                                <td>
                                    <a href="/pelatih/{{ $pelatih->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('pelatih.edit',['pelatih'=>$pelatih->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('pelatih.destroy',['pelatih'=>$pelatih->id]) }}" method="POST" class="d-inline">
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