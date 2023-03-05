@extends('layouts.main')
@section('title', trans('id.pengajuan.spt_singular'))
@section('desc', 'Formulir Pembuatan SPT')
@section('icon', 'file-signature')
@section('add_route', route('dashboard.pptk.spts.spt_tertunda'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card collapsed-card">
        <div class="card-header text-bold">
            {{ trans('id.lihat') }} {{ trans('id.pengajuan.judul') }}
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
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
                            Waktu pelaksanaan direncanakan selama {{ $jml_hari }}
                            ({{ App\Models\Pengajuan::penyebut($jml_hari) }} ) hari kerja dari hari
                            {{ $pengajuan->getTglBerangkatAtribute() }} sampai dengan
                            {{ $pengajuan->getTglKembaliAtribute() }}
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.pptk.spts.store', [$pengajuan->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_spt">{{ trans('id.pengajuan.tabel.no_spt') }}<span
                                    class="text-danger">*</span></label>
                            <div class="input-group {{ $errors->has('no_spt') ? 'has-error' : '' }}">
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text">700/</span>
                                </div> -->
                                <input type="text" id="no_spt" name="no_spt" class="form-control"
                                    value="{{ old('no_spt', isset($pengajuan) ? $pengajuan->no_spt : '') }}" required>
                                <!-- <div class="input-group-append">
                                    <span class="input-group-text">/SPT/IV.01/20/{{ $tahun }}</span>
                                </div> -->
                                @if ($errors->has('no_spt'))
                                    <p class="help-block text-danger">
                                        <strong>{{ $errors->first('no_spt') }}</strong>
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('id.pengajuan.tabel.no_spt_helper') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('tgl_terbit') ? 'has-error' : '' }}">
                            <label for="tgl_terbit">{{ trans('id.pengajuan.tabel.tgl_terbit') }}<span
                                    class="text-danger">*</span></label>
                            <div class="input-group date" id="tgl_terbitPicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="tgl_terbit"
                                    data-target="#tgl_terbitPicker" / required>
                                <div class="input-group-append" data-target="#tgl_terbitPicker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if ($errors->has('tgl_terbit'))
                                    <p class="help-block text-danger">
                                        <strong>{{ $errors->first('tgl_terbit') }}</strong>
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('id.pengajuan.tabel.tgl_terbit_helper') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('tembusan') ? 'has-error' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="tembusan">{{ trans('id.pengajuan.tabel.tembusan') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" id="tembusan" name="tembusan[]" class="form-control"
                                                >
                                            @if ($errors->has('tembusan'))
                                                <p class="help-block text-danger">
                                                    <strong>{{ $errors->first('tembusan') }}</strong>
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('id.pengajuan.tabel.tembusan_helper') }}
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="form-control btn btn-sm btn-primary addTembusan"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div id="addedTembusan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('dasar') ? 'has-error' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="dasar">{{ trans('id.pengajuan.tabel.dasar') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group clearfix">
                                            @foreach (App\Models\Pengajuan::dasar_select as $key => $dasar)
                                                <div class="icheck-danger d-block">
                                                    <input type="checkbox" id="dasar_{{$key}}" name="dasar[]" value="{{$dasar}}">
                                                    <label for="dasar_{{$key}}">{{$dasar}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" id="dasar" name="dasar[]" class="form-control"
                                                >
                                            @if ($errors->has('dasar'))
                                                <p class="help-block text-danger">
                                                    <strong>{{ $errors->first('dasar') }}</strong>
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('id.pengajuan.tabel.dasar_helper') }}
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="form-control btn btn-sm btn-primary addDasar"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div id="addedDasar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <input class="btn btn-danger" type="submit" value="{{ trans('id.simpan') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
