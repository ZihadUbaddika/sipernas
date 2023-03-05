@extends('layouts.main')
@section('title', trans('id.pengajuan.lhp_singular'))
@section('desc', 'Upload LHP')
@section('icon', 'file-alt')
@section('add_route', route('dashboard.pegawai.pengajuans.index'))
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
                            Waktu probity direncanakan selama {{ $jml_hari }}
                            ({{ App\Models\Pengajuan::penyebut($jml_hari) }} ) hari kerja dari tanggal
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
            <form action="{{ route('dashboard.pegawai.programkegiatans.store_lhp', [$pengajuan->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('no_lhp') ? 'has-error' : '' }}">
                            <label for="no_lhp">{{ trans('id.pengajuan.tabel.no_lhp') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="no_lhp" name="no_lhp" class="form-control"
                                value="{{ old('no_lhp', isset($pengajuan) ? $pengajuan->no_lhp : '') }}" maxlength="255"
                                required>
                            @if ($errors->has('no_lhp'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('no_lhp') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.no_lhp_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('tgl_submit') ? 'has-error' : '' }}">
                            <label for="tgl_submit">{{ trans('id.pengajuan.tabel.tgl_submit') }}<span
                                    class="text-danger">*</span></label>
                            <div class="input-group date" id="tgl_submitPicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="tgl_submit"
                                    data-target="#tgl_submitPicker" required>
                                <div class="input-group-append" data-target="#tgl_submitPicker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @if ($errors->has('tgl_submit'))
                                    <p class="help-block text-danger">
                                        <strong>{{ $errors->first('tgl_submit') }}</strong>
                                    </p>
                                @endif
                                <p class="helper-block">
                                    {{ trans('id.pengajuan.tabel.tgl_submit_helper') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('berkas') ? 'has-error' : '' }}">
                            <label for="berkas">{{ trans('id.pengajuan.tabel.berkas') }}<span
                                    class="text-danger"><span class="text-danger">*</span></span></label>
                            <div class="custom-file">
                                <input name="berkas" id="file-upload" onclick="change_fileName(this)" type="file"
                                    class="custom-file-input @error('file') is-invalid @enderror"
                                    aria-describedby="inputGroupFile01" lang="in" accept=".pdf,.docx,.doc" >
                                <label class="custom-file-label" for="file">Unggah berkas</label>
                            </div>
                            @if ($errors->has('berkas'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('berkas') }}</strong>
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('id.pengajuan.tabel.berkas_helper') }}
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
    <script type="text/javascript">
        function change_fileName(input) {
            $("#file-upload").on("change", function() {
                // Name of file and placeholder
                var file = this.files[0].name;
                var dflt = $(this).attr("placeholder");
                if ($(this).val() != "") {
                    $(this).next().text(file);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $(this).next().text(dflt);
                }
            });
        }
    </script>
@endsection
