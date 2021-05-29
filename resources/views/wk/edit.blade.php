@extends('layouts.mainadv')

@section('title', 'Edit Data Wakil Rektor III')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Data Wakil Rektor III</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('wk.update',['wk'=>$wk->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-group mt-3">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $wk->nama }}">
                                <div class="text-danger">{{ $errors->first('nama')}}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="user_name">Username</label>
                                <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" id="user_name" value="{{ $wk->user_name }}">
                                <div class="text-danger">{{ $errors->first('user_name')}}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="">
                                <div class="text-danger">{{ $errors->first('password') ? "" : "Kosongkan password jika tidak ingin diubah!" }}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $wk->email }}">
                                <div class="text-danger">{{ $errors->first('email')}}</div>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                            <a href="/wk" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection