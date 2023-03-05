@extends('layouts.main')
@section('title', 'Pengajuan')
@section('desc', 'Detail Pengajuan')
@section('icon', 'briefcase')
@section('add_route', route('dashboard.irban.pengajuans.index'))
@section('add_text', trans('id.kembali'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    {{ trans('id.lihat') }} {{ trans('id.pengajuan.judul') }}
                </div>
                <div class="col-md-6 text-right">
                    <form action="{{ route('dashboard.irban.pengajuans.cetak_notadinas', $pengajuan->id) }}" method="POST"
                        style="display: inline-block;" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-print" aria-hidden="true"></i> Cetak</button>
                    </form>
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
                    @if ($pengajuan->status_pengajuan == 'disubmit' && Gate::check('is_irban'))
                        <form action="{{ route('dashboard.irban.pengajuans.submit', $pengajuan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <tr>
                                <th>
                                    Persetujuan
                                </th>
                                <td class="text-left">
                                    <div class="form-group">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="radioSuccess1" name="status_pengajuan" value="terima"
                                                onchange="show('terima')" required>
                                            <label for="radioSuccess1">
                                                Setuju
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline ml-3">
                                            <input type="radio" id="radioPrimary2" name="status_pengajuan" value="tolak"
                                                onchange="show('tolak')" required>
                                            <label for="radioPrimary2">
                                                Tolak
                                            </label>
                                        </div>
                                    </div>
                                    <div id="showKet" style="display: none" class="form-group {{ $errors->has('keterangan_pengajuan') ? 'has-error' : '' }}">
                                        <textarea type="text" id="keterangan_pengajuan" name="keterangan_pengajuan" class="form-control"
                                            style="height: 100px;" placeholder="Keterangan penolakan . . ."
                                            ></textarea>
                                        @if ($errors->has('keterangan_pengajuan'))
                                            <p class="help-block text-danger">
                                                <strong>{{ $errors->first('keterangan_pengajuan') }}</strong>
                                            </p>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('id.pengajuan.tabel.keterangan_pengajuan_helper') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    
                                </th>
                                <td>

                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('dashboard.irban.pengajuans.index') }}"
                                                class="btn btn-default">{{ trans('id.batalkan') }}</a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn btn-danger" data-toggle="modal"
                                                data-target="#modal-default">Simpan</button>
                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                {{ trans('id.setujui') . ' ' . trans('id.pengajuan.judul_singular') }}
                                                            </h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-bold text-left">
                                                            <p>Anda yakin? <span
                                                                    class="text-success">{{ old('status_pengajuan') }}</span></span>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">{{ trans('id.kembali') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('id.ya') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endif                    
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
