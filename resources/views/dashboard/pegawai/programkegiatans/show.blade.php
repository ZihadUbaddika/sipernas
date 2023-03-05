@extends('layouts.main')
@section('title', 'Program Kegiatan')
@section('desc', 'Detail Program Kegiatan')
@section('icon', 'clipboard-list')
@section('add_route', route('dashboard.pegawai.programkegiatans.index'))
@section('add_text', trans('id.kembali'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    {{ trans('id.lihat') }} {{ trans('id.pengajuan.judul') }}
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                        </th>
                        <td>
                            {{ $pengajuan->nama_kegiatan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.jenis') }}
                        </th>
                        <td>
                            {{ $pengajuan->jenis ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.penanggung_jawab') }}
                        </th>
                        <td>
                            {{ $pengajuan->penanggungJawab->kepegawaian->nama ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.supervisor') }}
                        </th>
                        <td>
                            {{ $pengajuan->superVisor->kepegawaian->nama ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.pengendali_teknis') }}
                        </th>
                        <td>
                            {{ $pengajuan->pengendaliTeknis->kepegawaian->nama ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.ketua_tim') }}
                        </th>
                        <td>
                            {{ $pengajuan->ketuaTim->kepegawaian->nama ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.anggota') }}
                        </th>
                        <td>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    @foreach ($pengajuan->anggota as $anggota)
                                        <tr>
                                            <td class="px-2 py-2 text-sm">
                                                {{ $loop->iteration . '. ' . $anggota->user->kepegawaian->nama ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.objek') }}
                        </th>
                        <td>
                            {{ $pengajuan->objek ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.tujuan') }}
                        </th>
                        <td>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    @foreach ($pengajuan->tujuan as $tujuan)
                                        <tr>
                                            <td class="px-2 py-2 text-sm">
                                                {{ $loop->iteration . '. ' . $tujuan->tujuan ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.ruang_lingkup') }}
                        </th>
                        <td>
                            {{ $pengajuan->ruang_lingkup ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.rencana_pelaksanaan') }}
                        </th>
                        <td>
                            Waktu pelaksanaan direncanakan selama {{$jml_hari}} ({{App\Models\Pengajuan::penyebut($jml_hari)}} ) hari kerja dari hari {{$pengajuan->getTglBerangkatAtribute()}} sampai dengan {{$pengajuan->getTglKembaliAtribute()}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.tgl_pengajuan') }}
                        </th>
                        <td>
                            {{ $pengajuan->getTglPengajuanAtribute() ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.status_pengajuan') }}
                        </th>
                        <td>
                            {{ App\Models\Pengajuan::status_select[$pengajuan->status_pengajuan] ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.keterangan_pengajuan') }}
                        </th>
                        <td>
                            {{ $pengajuan->keterangan_pengajuan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-primary">
                            {{ trans('id.pengajuan.spt') }}
                        </th>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                        </th>
                        <td>
                            {{ $pengajuan->nama_kegiatan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.no_spt') }}
                        </th>
                        <td>
                            {{ $pengajuan->no_spt ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.tgl_terbit') }}
                        </th>
                        <td>
                            {{ $pengajuan->tgl_terbit ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-primary">
                            {{ trans('id.pengajuan.lhp') }}
                        </th>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.berkas') }}
                        </th>
                        <td>
                            {{ $pengajuan->berkas ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.pengajuan.tabel.tgl_submit') }}
                        </th>
                        <td>
                            {{ $pengajuan->tgl_submit ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function show(val) {
            var x = document.getElementById("showKet");
            var element = document.getElementById("keterangan_pengajuan");
            if (val == "tolak") {
                x.style.display = "block";
                element.setAttribute("required", "");
            } else {
                x.style.display = "none";
                element.removeAttribute("required");
            }
        }
    </script>
@endsection
