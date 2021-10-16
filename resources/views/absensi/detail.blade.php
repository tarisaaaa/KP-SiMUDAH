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

                        <div class="col-lg-6">
                            waaa
                        </div>

                        <div class="col-lg-6">
                            <form method="post" action="{{ route('absensi.detail') }}">
                                @csrf

                                <h2>Data Anggota</h2>


                                <button type="submit" class="btn btn-success btn-block border pt-2">Tambah Data</button>
                                <a href="#" class="btn btn-outline-secondary btn-block">Batal</a>
                                    
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection