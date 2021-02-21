@extends('layouts.mainadv')

@section('title', 'Edit Absensi')

@section('content')
<div class="container">
    <div class="col-lg-7">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="">Edit Absensi</h3>
            </div>

            <div class="card-body p-2 m-2">
                <div class="row">
                    <div class="container">

                        <form method="post" action="{{ route('absensi.update',['absensi'=>$absensi->id]) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group mt-3">
                                <label for="jml_kehadiran">Jumlah Kehadiran</label>
                                <input type="text" class="form-control @error('jml_kehadiran') is-invalid @enderror" name="jml_kehadiran" id="jml_kehadiran" value="{{ $absensi->jml_kehadiran }}">
                                <div class="text-danger">{{ $errors->first('jml_kehadiran')}}</div>
                                @error('jml_kehadiran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{!! ($absensi->keterangan) !!}</textarea>
                                <div class="text-danger">{{ $errors->first('keterangan')}}</div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="foto">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input @error('foto') is-invalid @enderror" name="foto" id="foto" value="{{ $absensi->foto }}">
                                    <label class="custom-file-label" for="foto">{{ $absensi->foto }}</label>
                                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <input type="text" hidden class="form-control" name="ukm_id" id="ukm_id" value="{{ $absensi->ukm_id }}">
                                <div class="text-danger">{{ $errors->first('ukm_id')}}</div>
                                @error('ukm_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mt-3">
                                <input type="text" hidden class="form-control" name="user_id" id="user_id" value="{{ $absensi->user_id }}">
                                <div class="text-danger">{{ $errors->first('user_id')}}</div>
                                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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