@extends('layouts.main')
@section('title', 'Users')
@section('desc', 'Tambah Data User')
@section('icon', 'user')
@section('add_route', route('dashboard.admin.users_management.users.index'))
@section('add_text', trans('id.kembali'))
@section('add_icon', 'arrow-left')
@section('content')
@include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('id.tambah') }} {{ trans('id.user.judul_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("dashboard.admin.users_management.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('kepegawaian_id') ? 'has-error' : '' }}">
                <label for="kepegawaian_id">{{ trans('id.user.tabel.kepegawaian_id') }}*</label>
                <select name="kepegawaian_id" id="kepegawaian_id" class="form-control select2bs4">
                    <option value="" selected>-- Silahkan pilih --</option>
                    @foreach($kepegawaian_id as $id => $kepegawaian_id)
                        <option value="{{ $id }}" {{ isset($kepegawaian_id) ? 'selected' : '' }}>
                            {{ $kepegawaian_id }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('kepegawaian_id'))
                    <p class="help-block">
                        {{ $errors->first('kepegawaian_id') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.user.tabel.kepegawaian_id_helper') }}
                </p>
            </div>  
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('id.user.tabel.email') }}*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                @if($errors->has('email'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.user.tabel.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('id.user.tabel.password') }}</label>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.user.tabel.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('id.user.tabel.roles') }}*
                    <span class="btn btn-info btn-xs select-all">Select all</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                            {{ $roles }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <p class="help-block text-danger">
                        <strong>{{ $errors->first('roles') }}</strong>
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('id.user.tabel.roles_helper') }}
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
