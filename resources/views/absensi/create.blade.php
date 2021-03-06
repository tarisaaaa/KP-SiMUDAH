@extends('layouts.mainadv')

@section('title', 'Tambah Absensi')

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
                <h3 class="mt-2">Tambah Absensi</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('absensi.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="jml_kehadiran">Jumlah Kehadiran</label>
                                <input type="text" class="form-control @error('jml_kehadiran') is-invalid @enderror" name="jml_kehadiran" id="jml_kehadiran" value="{{ old('jml_kehadiran') }}">
                                @error('jml_kehadiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"></textarea>
                                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="foto">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input @error('foto') is-invalid @enderror" name="foto" id="foto" value="{{ old('foto') }}">
                                    <label class="custom-file-label" for="foto">Upload foto</label>
                                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                @foreach ($ukm as $item)
                                    <input type="hidden" class="form-control @error('ukm_id') is-invalid @enderror" name="ukm_id" id="ukm_id" value="{{ $item->id }}">
                                
                            </div>

                            <div class="form-group mt-3" hidden>
                                <label for="user_id">Pelatih</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id" value="{{ session('user')->id }}">
                                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                            <a href="/absensi/{{$item->id}}" class="btn btn-outline-secondary btn-block">Batal</a>
                                @endforeach
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection