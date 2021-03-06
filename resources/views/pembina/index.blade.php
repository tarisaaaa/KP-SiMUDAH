@extends('layouts.mainadv')

@section('title', 'SiMUDAH | Pembina')

@section('content')
    <div class="container">
        <h1 class="ml-3">Pembina</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/pembina/create" class="btn btn-outline-secondary btn-flat">
                    <span class="text">Tambah Pembina</span>
                </a>
            </div>
            <div class="card-body p-2 m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>User Name</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $pembina)
                            <tr>
                                <td>{{ $pembina->nama }}</td>
                                <td>{{ $pembina->user_name }}</td>
                                <td>
                                    <a href="/pembina/{{ $pembina->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('pembina.edit',['pembina'=>$pembina->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('pembina.destroy',['pembina'=>$pembina->id]) }}" method="POST" class="d-inline">
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