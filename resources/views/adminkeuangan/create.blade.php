@extends('layouts.mainadv')

@section('title', 'Tambah Data Admin Keuangan')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow m-4">

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Data Admin Keuangan</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('adminkeuangan.store') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="nama">Nama Admin Keuangan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="user_name">Username</label>
                                <input type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" id="user_name" value="{{ old('user_name') }}">
                                @error('user_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="adminkeuangan">Admin Keuangan</option>
                                </select>
                                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="{{ route('adminkeuangan.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection