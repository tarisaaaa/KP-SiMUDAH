@extends('layouts.mainadv')

@section('title', 'Tambah Data Anggota')

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
                <h3 class="mt-2">Tambah Data Anggota</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('anggota.store') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" id="nama_anggota" value="{{ old('nama_anggota') }}">
                                @error('nama_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm" id="npm" value="{{ old('npm') }}">
                                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="nohp">Nomor HP</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" value="{{ old('nohp') }}">
                                @error('nohp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                @foreach ($ukm as $item)
                                    <input type="hidden" class="form-control @error('ukm_id') is-invalid @enderror" name="ukm_id" id="ukm_id" value="{{ $item->id }}">
                                
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="/anggota/{{$item->id}}" class="btn btn-outline-secondary btn-block">Batal</a>
                                @endforeach
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection