@extends('layouts.mainadv')

@section('title', 'Tambah Data Pengumuman')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow m-4">

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Pengumuman {{$ukm->nama_ukm}}</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('pengumuman.store') }}">
                            @csrf
                            

                            <div class="form-group mt-3">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ old('judul') }}">
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="isi">Isi</label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi" value="{{ old('isi') }}"></textarea>
                                @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="nama" hidden>Pengupload</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ session('user')->nama }} " hidden>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3" hidden>
                                <label for="ukm_id">UKM / HMJ</label>
                                <input type="text" class="form-control @error('ukm_id') is-invalid @enderror" name="ukm_id" id="ukm_id" value="{{ $ukm->id }} " hidden>
                                @error('ukm_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="/pengumuman/showperukm/{{$ukm->id}}" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection