@extends('layouts.mainadv')

@section('title', 'Tambah Absensi')

@section('content')
<div class="container">
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
                            <div class="row">
                            <div class="col-lg-5">
                                @csrf

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
                            </div>

                            <div class="col-lg-7 mt-3">

                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Nama Anggota</th>
                                        <th>H</th>
                                        <th>I</th>
                                        <th>A</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($anggota as $a)
                                            <tr>
                                                <td></td>
                                                <td>{{ $a->nama_anggota }}</td>
                                                <div class="form-group">
                                                    <td>
                                                        <input type="radio" name="status_absen" value="H">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="status_absen" value="I">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="status_absen" value="A">
                                                    </td>
                                                </div>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                                                        @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
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
@endsection