@extends('layouts.main')
@section('title', 'SPT')
@section('desc', 'Data SPT')
@section('icon', 'file-signature')
@section('content')
    @include('partials.widget.page-header-nobutton')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <b>{{ trans('id.daftar') }} {{ trans('id.pengajuan.spt_singular') }} <span class="badge bg-primary">{{ $wilayah_id != 'semua' ? "Wilayah $wilayah_id" : 'Semua Wilayah' }}</span></b>
                </div>
                <div class="col-md-4">
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
                    @foreach ($spts as $key => $spt)
                        <tr data-entry-id="{{ $spt->id }}">
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $spt->getTglTerbitAtribute() ?? '-' }}
                            </td>
                            <td>
                                @if ($spt->no_spt == null)
                                    SPT Belum diterbitkan
                                @else
                                    {{ $spt->nama_kegiatan ?? '-' }}
                                @endif
                            </td>
                            <td>
                                {{ $spt->objek ?? '-' }}
                            </td>
                            <td>
                                @if ($spt->no_spt == null)
                                    SPT Belum diterbitkan
                                @else
                                    {{ $spt->no_spt }}<br>
                                    <form action="{{ route('dashboard.pegawai.spts.cetak_spt', $spt->id) }}"
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
@endsection
