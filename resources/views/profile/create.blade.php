@extends('layouts.mainadv')

@section('title', 'Tambah Profil')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow m-4">

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Profil</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('profile.store') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="niknpm">NIK/NPM</label>
                                <input type="text" class="form-control @error('niknpm') is-invalid @enderror" name="niknpm" id="niknpm" value="{{ old('niknpm') }}">
                                @error('niknpm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="nohp">Nomor HP</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" value="{{ old('nohp') }}">
                                @error('nohp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat') }}">
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3" hidden>
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id" value="{{ session('user')->id }}">
                                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="/dashboard" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection