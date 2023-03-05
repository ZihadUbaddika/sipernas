@extends('layouts.main')
@section('title', trans('id.pengajuan.judul_singular'))
@section('desc', 'Lengkapi data Pengajuan')
@section('icon', 'file-alt')
@section('add_route', route('dashboard.pegawai.pengajuans.index'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.pegawai.pengajuans.update', [$pengajuan->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('nama_kegiatan') ? 'has-error' : '' }}">
                            <label for="nama_kegiatan">{{ trans('id.pengajuan.tabel.nama_kegiatan') }}<span
                                    class="text-danger">*</span></label>
                            <textarea type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" style="height: 100px;"
                                placeholder="Nama Kegiatan . . ." maxlength="255" required>{{ $pengajuan->nama_kegiatan ?? '' }}</textarea>
                            @if ($errors->has('nama_kegiatan'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('nama_kegiatan') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.nama_kegiatan_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}">
                            <label for="jenis">{{ trans('id.pengajuan.tabel.jenis') }}<span
                                    class="text-danger">*</span></label>
                            <select class="form-control select {{ $errors->has('jenis') ? 'is-invalid' : '' }}"
                                name="jenis" id="jenis" @if ($pengajuan->jenis == 'berkala' || $pengajuan->jenis == 'reguler' || $pengajuan->jenis == 'monev' || $pengajuan->jenis == 'reviu') '' @else disabled @endif>
                                <option value disabled {{ old('jenis', null) === null ? 'selected' : '' }}>
                                    {{ trans('id.silahkanPilih') }}</option>
                                @foreach (App\Models\Pengajuan::jenislhp_select as $key => $jenis)
                                    <option value="{{ $key }}"
                                        {{ $pengajuan->jenis === (string) $key ? 'selected' : '' }}>{{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <div class="icheck-danger d-inline">
                                <input type="checkbox" id="jenislainnya_check" name="jenislainnya_check"
                                    onchange="showJenisLainnya()" @if ($pengajuan->jenis == 'reguler' || $pengajuan->jenis == 'berkala' || $pengajuan->jenis == 'monev' || $pengajuan->jenis == 'reviu') '' @else checked @endif>
                                <label for="jenislainnya_check">Jenis lainnya</label>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jenis') ? 'has-error' : '' }}" id="jenislainnya_input"
                            style="display: @if ($pengajuan->jenis == 'reguler' || $pengajuan->jenis == 'berkala' || $pengajuan->jenis == 'monev' || $pengajuan->jenis == 'reviu') none @else block @endif">
                            <label for="jenis">{{ trans('id.pengajuan.tabel.jenis') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="jenis_input" name="jenis" class="form-control"
                                value="@if(!($pengajuan->jenis == 'reguler' || $pengajuan->jenis == 'berkala' || $pengajuan->jenis == 'monev' || $pengajuan->jenis == 'reviu'))  {{$pengajuan->jenis}} @endif" maxlength="255">
                            @if ($errors->has('jenis'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('jenis') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.jenis_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('penanggung_jawab') ? 'has-error' : '' }}">
                            <label for="penanggung_jawab">{{ trans('id.pengajuan.tabel.penanggung_jawab') }}<span
                                    class="text-danger">*</span></label>
                            <input type="hidden" name="penanggung_jawab" value="{{ $inspektur->id }}">
                            <select
                                class="form-control select2bs4RO {{ $errors->has('penanggung_jawab') ? 'is-invalid' : '' }}"
                                name="penanggung_jawab" id="penanggung_jawab" required>
                                <option value="{{ $inspektur->id }}" selected>
                                    {{ $inspektur->kepegawaian->nama }} -
                                    {{ $inspektur->kepegawaian->nip }}</option>
                            </select>
                            @if ($errors->has('penanggung_jawab'))
                                <p class="help-block text-danger mt-2">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $errors->first('penanggung_jawab') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.penanggung_jawab_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('supervisor') ? 'has-error' : '' }}">
                            <label for="supervisor">{{ trans('id.pengajuan.tabel.supervisor') }}<span
                                    class="text-danger">*</span></label>
                            <input type="hidden" name="supervisor" value="{{ $irban->id }}">
                            <select
                                class="form-control select2bs4RO {{ $errors->has('supervisor') ? 'is-invalid' : '' }}"
                                name="supervisor" id="supervisor" required>
                                <option value="{{ $irban->id }}" selected>
                                    {{ $irban->kepegawaian->nama }} -
                                    {{ $irban->kepegawaian->nip }}</option>
                            </select>
                            @if ($errors->has('supervisor'))
                                <p class="help-block text-danger mt-2">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $errors->first('supervisor') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.supervisor_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('pengendali_teknis') ? 'has-error' : '' }}">
                            <label for="pengendali_teknis">{{ trans('id.pengajuan.tabel.pengendali_teknis') }}<span
                                    class="text-danger">*</span></label>
                            <select
                                class="form-control select2bs4 {{ $errors->has('pengendali_teknis') ? 'is-invalid' : '' }}"
                                name="pengendali_teknis" id="pengendali_teknis" required>
                                <option value disabled {{ old('pengendali_teknis', null) === null ? 'selected' : '' }}>
                                    {{ trans('id.silahkanPilih') }}</option>
                                @foreach ($pengendali_teknis as $pengendali_teknis)
                                    <option value="{{ $pengendali_teknis->id }}"
                                        {{ $pengajuan->pengendali_teknis == $pengendali_teknis->id ? 'selected' : '' }}>
                                        {{ $pengendali_teknis->kepegawaian->nama }} -
                                        {{ $pengendali_teknis->kepegawaian->nip }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('pengendali_teknis'))
                                <p class="help-block text-danger mt-2">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $errors->first('pengendali_teknis') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.pengendali_teknis_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('ketua_tim') ? 'has-error' : '' }}">
                            <label for="ketua_tim">{{ trans('id.pengajuan.tabel.ketua_tim') }}<span
                                    class="text-danger">*</span></label>
                            <input type="hidden" name="ketua_tim" value="{{ Auth::user()->id }}">
                            <select class="form-control select2bs4RO {{ $errors->has('ketua_tim') ? 'is-invalid' : '' }}"
                                name="ketua_tim" id="ketua_tim" required disabled>
                                <option value disabled {{ old('ketua_tim', null) === null ? 'selected' : '' }}>
                                    {{ trans('id.silahkanPilih') }}</option>
                                <option value="{{ Auth::user()->id }}" selected>
                                    {{ Auth::user()->kepegawaian->nama }} -
                                    {{ Auth::user()->kepegawaian->nip }}</option>
                            </select>
                            @if ($errors->has('ketua_tim'))
                                <p class="help-block text-danger mt-2">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $errors->first('ketua_tim') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.ketua_tim_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('anggota') ? 'has-error' : '' }}">
                            <label for="anggota">{{ trans('id.pengajuan.tabel.anggota') }}<span
                                    class="text-danger">*</span></label></label>
                            <select name="anggota[]" id="anggota" class="form-control select2bs4" multiple="multiple"
                                required>
                                @foreach ($anggota as $anggota)
                                    <option value="{{ $anggota->id }}"
                                        {{ $pengajuan->anggota->contains('user_id', $anggota->id) ? 'selected' : '' }}>
                                        {{ $anggota->kepegawaian->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('anggota'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('anggota') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.anggota_helper') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('wilayah') ? 'has-error' : '' }}">
                            <label for="wilayah">{{ trans('id.pengajuan.tabel.wilayah') }}<span
                                    class="text-danger">*</span></label>
                            <input type="hidden" name="wilayah" value="{{ Auth::user()->roles[0]->wilayah->id }}">
                            <select class="form-control select2bs4RO {{ $errors->has('wilayah') ? 'is-invalid' : '' }}"
                                name="wilayah" id="wilayah" required>
                                <option value="{{ Auth::user()->roles[0]->wilayah->id }}" selected>
                                    {{ Auth::user()->roles[0]->wilayah->wilayah }}</option>
                            </select>
                            @if ($errors->has('wilayah'))
                                <p class="help-block text-danger mt-2">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                    {{ $errors->first('wilayah') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.wilayah_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('objek') ? 'has-error' : '' }}">
                            <label for="objek">{{ trans('id.pengajuan.tabel.objek') }}<span
                                    class="text-danger">*</span></label></label>
                            <input type="text" id="objek" name="objek" class="form-control"
                                value="{{ old('objek', isset($pengajuan) ? $pengajuan->objek : '') }}" required>
                            @if ($errors->has('objek'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('objek') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.objek_helper') }}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('tujuan') ? 'has-error' : '' }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="tujuan">{{ trans('id.pengajuan.tabel.tujuan') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" id="tujuan" name="tujuan[]" class="form-control"
                                                value="{{ old('tujuan', isset($pengajuan) ? $pengajuan->tujuan[0]->tujuan : '') }}"
                                                required>
                                            @if ($errors->has('tujuan'))
                                                <p class="help-block text-danger">
                                                    <strong>{{ $errors->first('tujuan') }}</strong>
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('id.pengajuan.tabel.tujuan_helper') }}
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button"
                                                class="form-control btn btn-sm btn-primary addTujuan"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div id="addedTujuan">
                                        @foreach ($pengajuan->tujuan as $tujuan)
                                            @if ($loop->iteration > 1)
                                                <div class="row" id="tujuanChild">
                                                    <div class="col-md-12">
                                                        <div
                                                            class="form-group {{ $errors->has('tujuan') ? 'has-error' : '' }}">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input type="text" id="tujuan" name="tujuan[]"
                                                                        class="form-control"
                                                                        value="{{ old('tujuan', isset($pengajuan) ? $tujuan->tujuan : '') }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button"
                                                                        class="form-control btn btn-sm btn-danger hapusTujuan"><i
                                                                            class="fas fa-trash-alt"
                                                                            aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('ruang_lingkup') ? 'has-error' : '' }}">
                            <label for="ruang_lingkup">{{ trans('id.pengajuan.tabel.ruang_lingkup') }}<span
                                    class="text-danger">*</span></label></label>
                            <input type="text" id="ruang_lingkup" name="ruang_lingkup" class="form-control"
                                value="{{ old('ruang_lingkup', isset($pengajuan) ? $pengajuan->ruang_lingkup : '') }}"
                                required>
                            @if ($errors->has('ruang_lingkup'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('ruang_lingkup') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.ruang_lingkup_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('uraian') ? 'has-error' : '' }}">
                            <label for="ruang_lingkup">{{ trans('id.pengajuan.tabel.uraian') }}<span
                                    class="text-danger">*</span></label>
                            <textarea type="text" id="uraian" name="uraian" class="form-control" style="height: 100px;"
                                placeholder="Uraian . . .">{{ $pengajuan->uraian }}</textarea>
                            @if ($errors->has('uraian'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('uraian') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.uraian_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('rencana_pelaksanaan') ? 'has-error' : '' }}">
                            <label for="rencana_pelaksanaan">{{ trans('id.pengajuan.tabel.rencana_pelaksanaan') }}<span
                                    class="text-danger">*</span></label></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right" name="rencana_kegiatan"
                                    id="reservationtime" value="{{$pengajuan->tgl_berangkat->format('d/m/Y').' - '.$pengajuan->tgl_kembali->format('d/m/Y')}}">
                            </div>
                            @if ($errors->has('rencana_pelaksanaan'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('rencana_pelaksanaan') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.rencana_pelaksanaan_helper') }}
                            </p>
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
@section('scripts')
    <script>
        $("#reservationtime").daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            locale: {
                format: "DD/MM/YYYY",
            },
        });
    </script>
    <script>
        function showJenisLainnya() {
            var jenislainnyainput = document.getElementById('jenislainnya_input');
            var jenisInput = document.getElementById('jenis_input');
            var jenisselect = document.getElementById('jenis');
            if (jenislainnyainput.style.display === 'none') {
                jenislainnyainput.style.display = 'block';
                jenisInput.removeAttribute('disabled');
                jenisselect.setAttribute('disabled', true);
            } else {
                jenislainnyainput.style.display = 'none';
                jenisselect.removeAttribute('disabled');
                jenisInput.setAttribute('disabled', true);
            }
        }
    </script>
@endsection
