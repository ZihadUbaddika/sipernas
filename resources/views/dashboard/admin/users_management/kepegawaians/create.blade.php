@extends('layouts.main')
@section('title', 'Kepegawaian')
@section('desc', 'Tambah Data Kepegawaian')
@section('icon', 'users')
@section('add_route', route('dashboard.admin.users_management.kepegawaians.index'))
@section('add_text', trans('id.kembali'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('id.tambah') }} {{ trans('id.kepegawaian.judul_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("dashboard.admin.users_management.kepegawaians.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">{{ trans('id.kepegawaian.tabel.nama') }}*</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', isset($user) ? $user->nama : '') }}">
                @if($errors->has('nama'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('nama') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.nama_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                <label for="nip">{{ trans('id.kepegawaian.tabel.nip') }}*</label>
                <input type="text" id="nip" name="nip" class="form-control" value="{{ old('nip', isset($user) ? $user->nip : '') }}">
                @if($errors->has('nip'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('nip') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.nip_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('pangkat') ? 'has-error' : '' }}">
                <label for="pangkat">{{ trans('id.kepegawaian.tabel.pangkat') }}*</label>
                <input type="text" id="pangkat" name="pangkat" class="form-control" value="{{ old('pangkat', isset($user) ? $user->pangkat : '') }}">
                @if($errors->has('pangkat'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('pangkat') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.pangkat_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('golongan') ? 'has-error' : '' }}">
                <label for="golongan">{{ trans('id.kepegawaian.tabel.golongan') }}*</label>
                <input type="text" id="golongan" name="golongan" class="form-control" value="{{ old('golongan', isset($user) ? $user->golongan : '') }}">
                @if($errors->has('golongan'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('golongan') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.golongan_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                <label for="semester">Foto<span class="text-danger"><span class="text-danger">*</span></span></label>
                <div class="custom-file">
                    <input name="foto" id="file-upload" onclick="change_fileName(this)" type="file" class="custom-file-input @error('file') is-invalid @enderror" aria-describedby="inputGroupFile01" lang="in" accept=".jpg,.png">
                    <label class="custom-file-label" for="file">Unggah foto</label>
                </div>
                @if($errors->has('foto'))
                <p class="help-block text-danger">
                    <strong>{{ $errors->first('foto') }}</strong>
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('id.kepegawaian.tabel.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                <label for="no_hp">{{ trans('id.kepegawaian.tabel.no_hp') }}*</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', isset($user) ? $user->no_hp : '') }}">
                @if($errors->has('no_hp'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('no_hp') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.kepegawaian.tabel.no_hp_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('id.simpan') }}">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function change_fileName(input){
    $("#file-upload").on("change", function(){
      // Name of file and placeholder
      var file = this.files[0].name;
      var dflt = $(this).attr("placeholder");
      if($(this).val()!=""){
        $(this).next().text(file);
        var reader = new FileReader();
    reader.onload = function (e) {
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
