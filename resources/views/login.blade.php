@extends('layouts.main')

@section('title', 'SiMUDAH | Login')

@section('content')
    <div class="container">
        <center>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">- SiMUDAH -</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('login') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-at"></i></div>
                                </div>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                                </div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm btn-block">LOGIN</button>
                            <br>
                            @if(session('gagal_login') == TRUE)
                            <small style="color:red">username atau password salah!</small>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </center>
    </div>
@endsection
