@extends('templatehome')

@section('content')
    <body id="page-top">
        <!-- Header-->
        <header class="bg-primary text-white">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Selamat Datang Di Website Inspektorat Provinsi Lampung</h1>
            </div>
        </header>
        <!-- Home section-->
        <section id="home">
            <div class="container px-4">
                <div class="row gx-4 gx-lg-5 align-items-center my-5">
                    <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('assets/img/inspektorathome.jpg') }}" alt="..." /></div>
                    <div class="col-lg-5">
                        <h1 class="font-weight-light">Inspektorat Provinsi Lampung</h1>
                        <p style="font-size:1.25rem" align="justify">Inspektorat merupakan unsur pengawasan internal penyelenggaraan Pemerintahan Daerah dan dipimpin oleh seorang Inspektur. Inspektur dalam melaksanakan tugas dan fungsinya bertanggung jawab langsung kepada Gubernur dan secara teknis administratif mendapat pembinaan dari Sekretaris Daerah.</p>
                    </div>
                </div>
            </div>
        </section>
    </body>
@endsection