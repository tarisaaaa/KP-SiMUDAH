@extends('layouts.mainadv')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Pengumuman</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('pengumuman.update',['pengumuman'=>$pengumuman->id]) }}">
                            @method('put')
                            @csrf
                            <div class="form-group mt-3">
                                <label for="ukm_id">UKM / HMJ</label>
                                <select name="ukm_id" id="ukm_id" class="form-control select2bs4 @error('ukm_id') is-invalid @enderror">
                                    <option value="Semua UKM/HMJ" {{ $pengumuman->ukm_id == 'Semua UKM/HMJ' ? 'selected' : ''}}>Semua UKM/HMJ</option>
                                    @foreach ($ukm as $ukm)
                                        <option value="{{ $ukm->id }}" {{ $pengumuman->ukm_id == $ukm->id ? 'selected' : ''}}>{{ $ukm->nama_ukm }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ $pengumuman->judul }}">
                                <div class="text-danger">{{ $errors->first('judul')}}</div>
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="isi">Isi</label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi">{!! ($pengumuman->isi) !!}</textarea>
                                <div class="text-danger">{{ $errors->first('isi')}}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="nama" hidden>Pengupload</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $pengumuman->nama }} " hidden>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Edit Data</button>
                            <a href="/pengumuman" class="btn btn-outline-secondary btn-block">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection