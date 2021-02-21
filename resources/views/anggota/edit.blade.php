@extends('layouts.mainadv')

@section('title', 'Edit Data Anggota')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Data Anggota</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('anggota.update',['anggotum'=>$anggota->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-group mt-3">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" id="nama_anggota" value="{{ $anggota->nama_anggota }}">
                                <div class="text-danger">{{ $errors->first('nama_anggota')}}</div>
                                @error('nama_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm" id="npm" value="{{ $anggota->npm }}">
                                <div class="text-danger">{{ $errors->first('npm')}}</div>
                                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="nohp">Nomor HP</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" value="{{ $anggota->nohp }}">
                                <div class="text-danger">{{ $errors->first('nohp')}}</div>
                                @error('nohp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $anggota->email }}">
                                <div class="text-danger">{{ $errors->first('email')}}</div>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <input type="text" hidden class="form-control" name="ukm_id" id="ukm_id" value="{{ $anggota->ukm_id }}">
                                <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
                                @error('ukm_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection