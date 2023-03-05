@extends('layouts.main')
@section('title', trans('id.pengajuan.judul_singular'))
@section('desc', trans('id.pengajuan.deskripsi'))
@section('icon', 'file-alt')
@section('add_route', route('dashboard.pegawai.pengajuans.create'))
@section('add_text', trans('id.tambah'))
@section('content')
    @can('pengajuan_create')
        @include('partials.widget.page-header')
    @endcan
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <b>
                        {{ trans('id.daftar') }} {{ trans('id.pengajuan.judul_singular') }} 
                        <span class="badge bg-primary">{{ $wilayah_id != 'semua' ? "Wilayah $wilayah_id" : 'Semua Wilayah' }}</span></b>
                </div>
                <div class="col-md-4 text-right">
                    <form action="#" method="get">
                        <div class="input-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                            <select class="form-control select {{ $errors->has('wilayah_id') ? 'is-invalid' : '' }}"
                                name="wilayah_id" id="wilayah_id" required>
                                <option value disabled {{ old('wilayah_id', null) === null ? 'selected' : '' }}>
                                    {{ trans('id.silahkanPilih') }}</option>
                                @foreach (App\Models\Pengajuan::wilayah_select as $key => $wilayah)
                                    <option value="{{ $key }}"
                                        {{ $wilayah_id === (string) $key ? 'selected' : '' }}>{{ $wilayah }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <Button class="btn btn-primary"><i class="fas fa-magnifying-glass"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="perlu_disetujui-tab" data-toggle="pill" href="#perlu_disetujui"
                                role="tab" aria-controls="perlu_disetujui" aria-selected="false">Perlu Disetujui <span
                                    class="badge bg-danger">{{ $perlu_disetujui->count() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="diterima-tab" data-toggle="pill" href="#diterima" role="tab"
                                aria-controls="diterima" aria-selected="false">Diterima <span
                                    class="badge bg-success">{{ $diterima->count() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ditolak-tab" data-toggle="pill" href="#ditolak" role="tab"
                                aria-controls="ditolak" aria-selected="false">Ditolak <span
                                    class="badge bg-warning">{{ $ditolak->count() }}</span></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="perlu_disetujui" role="tabpanel"
                            aria-labelledby="perlu_disetujui-tab">
                            <table id="example1" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.status_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.keterangan_pengajuan') }}
                                        </th>
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perlu_disetujui as $key => $pengajuan)
                                        <tr data-entry-id="{{ $pengajuan->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->getTglPengajuanAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->nama_kegiatan ?? '' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->objek ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Pengajuan::status_select[$pengajuan->status_pengajuan] ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->keterangan_pengajuan ?? '-' }}
                                            </td>
                                            <td width="110" class="text-center">
                                                @can('pengajuan_show')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('dashboard.inspektur.pengajuans.show', $pengajuan->id) }}">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="diterima" role="tabpanel" aria-labelledby="diterima-tab">
                            <table id="example3" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>

                                        <th>
                                            {{ trans('id.pengajuan.tabel.status_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.keterangan_pengajuan') }}
                                        </th>
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($diterima as $key => $pengajuan)
                                        <tr data-entry-id="{{ $pengajuan->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->getTglPengajuanAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->nama_kegiatan ?? '' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->objek ?? '' }}
                                            </td>
                                            <td>
                                                {{ App\Models\Pengajuan::status_select[$pengajuan->status_pengajuan] ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->keterangan_pengajuan ?? '-' }}
                                            </td>
                                            <td width="110" class="text-center">
                                                @can('pengajuan_show')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('dashboard.inspektur.pengajuans.show', $pengajuan->id) }}">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
                            <table id="example4" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.perihal') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>

                                        <th>
                                            {{ trans('id.pengajuan.tabel.status_pengajuan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.keterangan_pengajuan') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ditolak as $key => $pengajuan)
                                        <tr data-entry-id="{{ $pengajuan->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->getTglPengajuanAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->nama_kegiatan ?? '' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->objek ?? '' }}
                                            </td>

                                            <td>
                                                {{ App\Models\Pengajuan::status_select[$pengajuan->status_pengajuan] ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $pengajuan->keterangan_pengajuan ?? '-' }}
                                            </td>
                                            <td width="110" class="text-center">
                                                @can('pengajuan_show')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('dashboard.inspektur.pengajuans.show', $pengajuan->id) }}">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
