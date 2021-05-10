@extends('layouts.mainadv')

@section('title', 'MDP UKM | Wakil Rektor III')

@section('content')
    <div class="container">
        <h1 class="ml-3">Wakil Ketua 3</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow m-4">
            <div class="card-header py-3">
                <a href="/wk/create" class="btn btn-outline-secondary btn-flat">
                    <span class="text">Tambah Wakil Rektor III</span>
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
                            @foreach($users as $wk)
                            <tr>
                                <td>{{ $wk->nama }}</td>
                                <td>{{ $wk->user_name }}</td>
                                <td>
                                    <a href="/wk/{{ $wk->id}}" class="btn btn-warning btn-sm"><i class="fas fa-info"></i></a>
                                    <a href="{{ route('wk.edit',['wk'=>$wk->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('wk.destroy',['wk'=>$wk->id]) }}" method="POST" class="d-inline">
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