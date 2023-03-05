@extends('layouts.main')
@section('title', 'Beranda')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Selamat datang, 
                <span class="text-warning">{{ Auth::user()->kepegawaian->nama }}</span>!</h5>
            </div>
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $admin_dashboard['count_pegawai'] }}</h3>
                            <p>Jumlah Pegawai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('dashboard.admin.users_management.kepegawaians.index') }}" class="small-box-footer">More
                            info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
