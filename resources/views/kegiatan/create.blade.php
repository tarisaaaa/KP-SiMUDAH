@extends('layouts.mainadv')

@section('title', 'Tambah Data Kegitan')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow m-4">

            <div class="card-header py-3">
                <h3 class="mt-2">Tambah Data Kegiatan</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('kegiatan.store') }}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="ukm_id">UKM / HMJ</label>
                                <select name="ukm_id" id="ukm_id" class="form-control @error('ukm_id') is-invalid @enderror">
                                    <option value="" hidden></option>
                                    @foreach ($ukm as $ukm)
                                        <option value="{{ $ukm->id }} {{ old('ukm_id') }}">{{ $ukm->nama_ukm }}</option>
                                    @endforeach
                                </select>
                                @error('ukm_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="nama_kegiatan">Kegiatan</label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                                @error('nama_kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"></textarea>
                                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection