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
            {{ trans('id.daftar') }} {{ trans('id.pengajuan.judul_singular') }}
        </div>
        <div class="card-body">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        @can('pengajuan_create')
                            <li class="nav-item">
                                <a class="nav-link active" id="belum-disubmit-tab" data-toggle="pill" href="#belum-disubmit"
                                    role="tab" aria-controls="belum-disubmit" aria-selected="true">Belum disubmit <span
                                        class="badge bg-danger">{{ $belum_disubmit->count() }}</span></a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link" id="disubmit-tab" data-toggle="pill" href="#disubmit" role="tab"
                                aria-controls="disubmit" aria-selected="false">Disubmit <span
                                    class="badge bg-primary">{{ $disubmit->count() }}</span></a>
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
                        @can('pengajuan_create')
                            <div class="tab-pane fade show active" id="belum-disubmit" role="tabpanel" aria-labelledby="belum-disubmit-tab">
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
                                        @foreach ($belum_disubmit as $key => $pengajuan)
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
                                                    <br>
                                                    @if ($pengajuan->status_pengajuan == 'disimpan' && Auth::user()->id == $pengajuan->ketua_tim)
                                                        <form
                                                            action="{{ route('dashboard.pegawai.pengajuans.submit', $pengajuan->id) }}"
                                                            method="POST" style="display: inline-block;" class="mt-2">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#submit-modal_{{ $pengajuan->id }}">Submit?</button>
                                                            <div class="modal fade" id="submit-modal_{{ $pengajuan->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ trans('id.submit') . ' ' . trans('id.pengajuan.judul_singular') }}!
                                                                            </h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body text-bold">
                                                                            <p>Pastikan data sudah diisi dengan benar sebelum
                                                                                melakukan submit!
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal">{{ trans('id.kembali') }}</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">{{ trans('id.submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $pengajuan->keterangan_pengajuan ?? '-' }}
                                                </td>
                                                <td width="110" class="text-center">
                                                    @can('pengajuan_show')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('dashboard.pegawai.pengajuans.show', $pengajuan->id) }}">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    @endcan
                                                    @if (($pengajuan->status_pengajuan == 'disimpan' || Gate::check('user_management_access')) && Auth::user()->id == $pengajuan->ketua_tim)
                                                        @can('pengajuan_edit')
                                                            <a class="btn btn-sm btn-warning"
                                                                href="{{ route('dashboard.pegawai.pengajuans.edit', $pengajuan->id) }}">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                        @endcan
                                                        @can('pengajuan_delete')
                                                            <form
                                                                action="{{ route('dashboard.pegawai.pengajuans.destroy', $pengajuan->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    data-toggle="modal"
                                                                    data-target="#delete-modal_{{ $pengajuan->id }}">
                                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                                                <div class="modal fade" id="delete-modal_{{ $pengajuan->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">
                                                                                    {{ trans('id.hapus') . ' ' . trans('id.pengajuan.judul_singular') }}!
                                                                                </h4>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{{ trans('id.andaYakin') }}</p>
                                                                            </div>
                                                                            <div class="modal-footer justify-content-between">
                                                                                <button type="button" class="btn btn-default"
                                                                                    data-dismiss="modal">{{ trans('id.tidak') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">{{ trans('id.ya') }}</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endcan
                        <div class="tab-pane fade" id="disubmit" role="tabpanel"
                            aria-labelledby="disubmit-tab">
                            <table id="example2" class=" table table-bordered table-striped table-hover datatable">
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
                                    @foreach ($disubmit as $key => $pengajuan)
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
                                                        href="{{ route('dashboard.pegawai.pengajuans.show', $pengajuan->id) }}">
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
                                                        href="{{ route('dashboard.pegawai.pengajuans.show', $pengajuan->id) }}">
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
                                                        href="{{ route('dashboard.pegawai.pengajuans.show', $pengajuan->id) }}">
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
