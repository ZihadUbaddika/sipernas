@extends('layouts.main')
@section('title', trans('id.pengajuan.programkegiatan_singular'))
@section('desc', trans('id.pengajuan.programkegiatan'))
@section('icon', 'file-alt')
@section('content')
    @include('partials.widget.page-header-nobutton')
    <div class="card">
        <div class="card-header">
            {{ trans('id.daftar') }} {{ trans('id.pengajuan.programkegiatan_singular') }}
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
                                @if ($programkegiatan->no_spt == null)
                                    <span class="text-danger text-bold">SPT belum diterbitkan</span>
                                @else
                                    {{ $programkegiatan->nama_kegiatan ?? '-' }}
                                @endif
                            </td>
                            <td>
                                {{ $programkegiatan->objek ?? '-' }}
                            </td>
                            <td>
                                @if ($programkegiatan->no_spt == null)
                                    <span class="text-danger text-bold">SPT belum diterbitkan</span>
                                @else
                                    {{ $programkegiatan->no_spt }}<br>
                                    <form action="{{ route('dashboard.pegawai.spts.cetak_spt', $programkegiatan->id) }}"
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

                            <td>
                                @if ($programkegiatan->no_spt == null)
                                    <span class="text-danger text-bold">SPT belum diterbitkan</span>
                                @elseif($programkegiatan->no_lhp == null)
                                    Belum ada LHP !<br>
                                    @if($programkegiatan->ketua_tim == $user_id)
                                    <a class="btn btn-sm bg-white mt-2"
                                        href="{{ route('dashboard.pegawai.programkegiatans.upload_lhp', $programkegiatan->id) }}">
                                        <i class="fas fa-upload" aria-hidden="true"></i> Upload LHP
                                    </a>
                                    @endif
                                @else
                                    <form
                                        action="{{ route('dashboard.pegawai.programkegiatans.download_lhp', $programkegiatan->id) }}"
                                        method="POST" class="mt-2" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm bg-default">
                                            <i class="fas fa-print" aria-hidden="true"></i> Unduh</button>
                                    </form>
                                @endif
                            </td>

                            <td width=80" class="text-center">
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('dashboard.pegawai.programkegiatans.show', $programkegiatan->id) }}">
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
