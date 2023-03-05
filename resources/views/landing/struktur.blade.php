@extends('templatehome')

@section('content')
    <header style="background-color: #ced4da;">
    <div class="container-sm">
        <h1 class="fw-normal">Struktur Organisasi Inspektorat Provinsi Lampung</h1>
    </div>
    </header>
    <body id="page-top">
        <!-- Home section-->
        <section id="home">
            <div class="container px-4">
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('assets/img/struktur.jpg') }}" alt="..." />
                </div>
                <br>
                <div>
                <h2>Keterangan :</h2>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $inspektur->kepegawaian->nip }}</td>
                                <td>{{ $inspektur->kepegawaian->nama }}</td>
                                <td>{{ $inspektur->kepegawaian->golongan }}</td>
                                <td>Inspektur</td>
                            </tr>
                            <tr>
                                <td>{{ $sekretaris->kepegawaian->nip }}</td>
                                <td>{{ $sekretaris->kepegawaian->nama }}</td>
                                <td>{{ $sekretaris->kepegawaian->golongan }}</td>
                                <td>Sekretaris</td>
                            </tr>
                            <tr>
                                <td>{{ $umum->kepegawaian->nip }}</td>
                                <td>{{ $umum->kepegawaian->nama }}</td>
                                <td>{{ $umum->kepegawaian->golongan }}</td>
                                <td>Subbag. Umum dan Keuangan</td>
                            </tr>
                            <tr>
                                <td>{{ $analisis->kepegawaian->nip }}</td>
                                <td>{{ $analisis->kepegawaian->nama }}</td>
                                <td>{{ $analisis->kepegawaian->golongan }}</td>
                                <td>Subbag. Analisis dan Evaluasi</td>
                            </tr>
                            <tr>
                                <td>{{ $perencanaan->kepegawaian->nip }}</td>
                                <td>{{ $perencanaan->kepegawaian->nama }}</td>
                                <td>{{ $perencanaan->kepegawaian->golongan }}</td>
                                <td>Subbag. Perencanaan</td>
                            </tr>
                            <tr>
                                <td>{{ $irban1->kepegawaian->nip }}</td>
                                <td>{{ $irban1->kepegawaian->nama }}</td>
                                <td>{{ $irban1->kepegawaian->golongan }}</td>
                                <td>Inspektur Pembantu Wilayah 1</td>
                            </tr>
                            <tr>
                                <td>{{ $irban2->kepegawaian->nip }}</td>
                                <td>{{ $irban2->kepegawaian->nama }}</td>
                                <td>{{ $irban2->kepegawaian->golongan }}</td>
                                <td>Inspektur Pembantu Wilayah 2</td>
                            </tr>
                            <tr>
                                <td>{{ $irban3->kepegawaian->nip }}</td>
                                <td>{{ $irban3->kepegawaian->nama }}</td>
                                <td>{{ $irban3->kepegawaian->golongan }}</td>
                                <td>Inspektur Pembantu Wilayah 3</td>
                            </tr>
                            <tr>
                                <td>{{ $irban4->kepegawaian->nip }}</td>
                                <td>{{ $irban4->kepegawaian->nama }}</td>
                                <td>{{ $irban4->kepegawaian->golongan }}</td>
                                <td>Inspektur Pembantu Wilayah 4</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
@endsection