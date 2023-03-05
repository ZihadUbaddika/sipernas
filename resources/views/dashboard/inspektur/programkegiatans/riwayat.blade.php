@extends('layouts.main')
@section('title', trans('id.pengajuan.riwayatkegiatan_singular'))
@section('desc', trans('id.pengajuan.riwayatkegiatan'))
@section('icon', 'file-alt')
@section('content')
    @include('partials.widget.page-header-nobutton')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    {{ trans('id.daftar') }} {{ trans('id.pengajuan.riwayatkegiatan_singular') }}
                    <span
                        class="badge bg-primary">{{ $wilayah_id != 'semua' ? "Wilayah $wilayah_id" : 'Semua Wilayah' }}</span></b>
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
            <table id="example1" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">
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
                        <th>
                            {{ trans('id.pengajuan.tabel.no_lhp') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programkegiatans as $key => $programkegiatan)
                        <tr data-entry-id="{{ $programkegiatan->id }}">
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $programkegiatan->nama_kegiatan ?? '-' }}
                            </td>
                            <td>
                                {{ $programkegiatan->objek ?? '-' }}
                            </td>
                            <td>
                                {{ $programkegiatan->no_spt }}<br>
                                <form action="{{ route('dashboard.inspektur.spts.cetak_spt', $programkegiatan->id) }}"
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
                            </td>
                            <td>
                                {{ $programkegiatan->no_lhp }}<br>
                                <form
                                    action="{{ route('dashboard.inspektur.programkegiatans.download_lhp', $programkegiatan->id) }}"
                                    method="POST" class="mt-2" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fas fa-file-download" aria-hidden="true"></i> Unduh</button>
                                </form>
                            </td>
                            <td width=80" class="text-center">
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('dashboard.inspektur.programkegiatans.show', $programkegiatan->id) }}">
                                    <i class="fas fa-eye" aria-hidden="true"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
