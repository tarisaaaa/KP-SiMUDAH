@extends('layouts.mainadv')

@section('title', 'MDP UKM | Admin Keuangan')

@section('content')
    <div class="container">
        <h1 class="ml-3">Admin Keuangan</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/adminkeuangan/create" class="btn btn-outline-secondary btn-flat">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                    </span>
                    <span class="text">Tambah Admin Keuangan</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Admin</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $adminkeuangan)
                            <tr>
                                <td>{{ $adminkeuangan->nama }}</td>
                                <td>{{ $adminkeuangan->user_name }}</td>
                                <td>{{ $adminkeuangan->email }}</td>
                                <td>
                                    <a href="/adminkeuangan/{{ $adminkeuangan->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('adminkeuangan.edit',['adminkeuangan'=>$adminkeuangan->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('adminkeuangan.destroy',['adminkeuangan'=>$adminkeuangan->id]) }}" method="POST" class="d-inline">
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