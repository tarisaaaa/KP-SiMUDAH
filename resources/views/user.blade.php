@extends('layouts.mainadv')

@section('title', 'SiMUDAH | User')

@section('content')
    <div class="container">
        <h1>@section('subtitle', 'Dashboard')</h1>

        <div class="row m-5">
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Pelatih</h3>
                  <h6><br></h6>
                </div>
                <div class="icon">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="/pelatih" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3>Admin</h3>
                  <h5>Keuangan</h5>
                </div>
                <div class="icon">
                  <i class="fas fa-user-cog"></i>
                </div>
                <a href="/adminkeuangan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-pink">
                <div class="inner">
                  <h3>Admin</h3>
                  <h5>Aplikasi</h5>
                </div>
                <div class="icon">
                  <i class="fas fa-user-shield"></i>
                </div>
                <a href="/adminaplikasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3>Ketua</h3>
                  <h5>Mahasiswa</h5>
                </div>
                <div class="icon">
                  <i class="fas fa-user-graduate"></i>
                </div>
                <a href="/ketuamhs" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>Pembina</h3>
                  <h5><br></h5>
                </div>
                <div class="icon">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="/pembina" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                <div class="inner">
                  <h3>WR III</h3>
                  <h5><br></h5>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="/wk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
    </div>
@endsection