@extends('layouts.main')
@section('title', 'Data SPT')
@section('desc', 'Manajemen data SPT')
@section('icon', 'file-signature')
@section('content')
    @include('partials.widget.page-header-nobutton')
    <div class="card">
        <div class="card-header">
            {{ trans('id.daftar') }} {{ trans('id.pengajuan.judul_singular') }}
        </div>
        <div class="card-body">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="wilayah1-tab" data-toggle="pill" href="#wilayah1" role="tab"
                                aria-controls="wilayah1" aria-selected="true">Wilayah 1 <span
                                    class="badge bg-warning">{{ $sptswil1->count() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="wilayah2-tab" data-toggle="pill" href="#wilayah2" role="tab"
                                aria-controls="wilayah2" aria-selected="false">Wilayah 2 <span
                                    class="badge bg-warning">{{ $sptswil2->count() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="wilayah3-tab" data-toggle="pill" href="#wilayah3" role="tab"
                                aria-controls="wilayah3" aria-selected="false">Wilayah 3 <span
                                    class="badge bg-warning">{{ $sptswil3->count() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="wilayah4-tab" data-toggle="pill" href="#wilayah4" role="tab"
                                aria-controls="wilayah4" aria-selected="false">Wilayah 4 <span
                                    class="badge bg-warning">{{ $sptswil4->count() }}</span></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="wilayah1" role="tabpanel"
                            aria-labelledby="wilayah1-tab">
                            <table id="example1" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_terbit') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.no_spt') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sptswil1 as $key => $spt)
                                        <tr data-entry-id="{{ $spt->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $spt->getTglTerbitAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->nama_kegiatan ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->objek ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($spt->no_spt == null)
                                                    SPT Belum diterbitkan<br>
                                                    <a class="btn btn-sm btn-warning mt-2"
                                                        href="{{ route('dashboard.pptk.spts.create', $spt->id) }}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Tambah
                                                    </a>
                                                @else
                                                    {{ $spt->no_spt }}<br>
                                                    <form action="{{ route('dashboard.pptk.spts.cetak_spt', $spt->id) }}"
                                                        method="POST" class="mt-2" style="display: inline-block;">
                                                        @csrf
                                                        <div class="input-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                                                            <select class="form-control select {{ $errors->has('paraf') ? 'is-invalid' : '' }}"
                                                                name="paraf" id="paraf" required>
                                                                <option value disabled {{ old('paraf', null) === null ? 'selected' : '' }}>
                                                                    {{ trans('id.silahkanPilih') }}</option>
                                                                @foreach (App\Models\Pengajuan::cetakspt_select as $key => $paraf)
                                                                    <option value="{{ $key }}">{{ $paraf }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-file-download" aria-hidden="true"></i>
                                                                    Unduh</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="wilayah2" role="tabpanel" aria-labelledby="wilayah2-tab">
                            <table id="example2" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_terbit') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.no_spt') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sptswil2 as $key => $spt)
                                        <tr data-entry-id="{{ $spt->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $spt->getTglTerbitAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->nama_kegiatan ?? '-' }}
                                            </td>
                                            </td>
                                            <td>
                                                {{ $spt->objek ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($spt->no_spt == null)
                                                    SPT Belum diterbitkan<br>
                                                    <a class="btn btn-sm btn-warning mt-2"
                                                        href="{{ route('dashboard.pptk.spts.create', $spt->id) }}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Tambah
                                                    </a>
                                                @else
                                                    {{ $spt->no_spt }}<br>
                                                    <form action="{{ route('dashboard.pptk.spts.cetak_spt', $spt->id) }}"
                                                        method="POST" class="mt-2" style="display: inline-block;">
                                                        @csrf
                                                        <div class="input-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                                                            <select class="form-control select {{ $errors->has('paraf') ? 'is-invalid' : '' }}"
                                                                name="paraf" id="paraf" required>
                                                                <option value disabled {{ old('paraf', null) === null ? 'selected' : '' }}>
                                                                    {{ trans('id.silahkanPilih') }}</option>
                                                                @foreach (App\Models\Pengajuan::cetakspt_select as $key => $paraf)
                                                                    <option value="{{ $key }}">{{ $paraf }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-file-download" aria-hidden="true"></i>
                                                                    Unduh</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="wilayah3" role="tabpanel" aria-labelledby="wilayah3-tab">
                            <table id="example3" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_terbit') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.no_spt') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sptswil3 as $key => $spt)
                                        <tr data-entry-id="{{ $spt->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $spt->getTglTerbitAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->nama_kegiatan ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->objek ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($spt->no_spt == null)
                                                    SPT Belum diterbitkan<br>
                                                    <a class="btn btn-sm btn-warning mt-2"
                                                        href="{{ route('dashboard.pptk.spts.create', $spt->id) }}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Tambah
                                                    </a>
                                                @else
                                                    {{ $spt->no_spt }}<br>
                                                    <form action="{{ route('dashboard.pptk.spts.cetak_spt', $spt->id) }}"
                                                        method="POST" class="mt-2" style="display: inline-block;">
                                                        @csrf
                                                        <div class="input-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                                                            <select class="form-control select {{ $errors->has('paraf') ? 'is-invalid' : '' }}"
                                                                name="paraf" id="paraf" required>
                                                                <option value disabled {{ old('paraf', null) === null ? 'selected' : '' }}>
                                                                    {{ trans('id.silahkanPilih') }}</option>
                                                                @foreach (App\Models\Pengajuan::cetakspt_select as $key => $paraf)
                                                                    <option value="{{ $key }}">{{ $paraf }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-file-download" aria-hidden="true"></i>
                                                                    Unduh</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="wilayah4" role="tabpanel" aria-labelledby="wilayah4-tab">
                            <table id="example4" class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.tgl_terbit') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.nama_kegiatan') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.objek') }}
                                        </th>
                                        <th>
                                            {{ trans('id.pengajuan.tabel.no_spt') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sptswil4 as $key => $spt)
                                        <tr data-entry-id="{{ $spt->id }}">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $spt->getTglTerbitAtribute() ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->nama_kegiatan ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $spt->objek ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($spt->no_spt == null)
                                                    SPT Belum diterbitkan<br>
                                                    <a class="btn btn-sm btn-warning mt-2"
                                                        href="{{ route('dashboard.pptk.spts.create', $spt->id) }}">
                                                        <i class="fas fa-plus" aria-hidden="true"></i> Tambah
                                                    </a>
                                                @else
                                                    {{ $spt->no_spt }}<br>
                                                    <form action="{{ route('dashboard.pptk.spts.cetak_spt', $spt->id) }}"
                                                        method="POST" class="mt-2" style="display: inline-block;">
                                                        @csrf
                                                        <div class="input-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                                                            <select class="form-control select {{ $errors->has('paraf') ? 'is-invalid' : '' }}"
                                                                name="paraf" id="paraf" required>
                                                                <option value disabled {{ old('paraf', null) === null ? 'selected' : '' }}>
                                                                    {{ trans('id.silahkanPilih') }}</option>
                                                                @foreach (App\Models\Pengajuan::cetakspt_select as $key => $paraf)
                                                                    <option value="{{ $key }}">{{ $paraf }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-file-download" aria-hidden="true"></i>
                                                                    Unduh</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
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
