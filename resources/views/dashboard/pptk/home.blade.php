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
                            <h3>{{$pptk_dashboard['count_sptterbit']}}</h3>

                            <p>SPT Terbit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('dashboard.pptk.spts.spt_terbit')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$pptk_dashboard['count_spttertunda']}}</h3>

                            <p>SPT Tertunda</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('dashboard.pptk.spts.spt_tertunda')}}" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
@endsection
