@extends('layouts.main')
@section('title', 'Roles')
@section('desc', 'Tambah Data Roles')
@section('icon', 'briefcase')
@section('add_route', route('dashboard.admin.users_management.roles.index'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('global.role.title_singular') }}
        </div>

        <div class="card-body">
            <form action="{{ route('dashboard.admin.users_management.roles.update', [$role->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">{{ trans('global.role.fields.title') }}*</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', isset($role) ? $role->title : '') }}">
                    @if ($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.role.fields.title_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('tipe') ? 'has-error' : '' }}">
                    <label for="tipe">{{ trans('id.pengajuan.tabel.wilayah') }}<span
                            class="text-danger">*</span></label>
                    <select class="form-control select {{ $errors->has('tipe') ? 'is-invalid' : '' }}" name="tipe"
                        id="tipe" required>
                        <option value disabled {{ old('tipe', null) === null ? 'selected' : '' }}>
                            {{ trans('id.silahkanPilih') }}</option>
                        @foreach (App\Models\UserManagement\Role::tipe_select as $key => $tipe)
                            <option value="{{ $key }}" {{ $role->tipe === (string) $key ? 'selected' : '' }}>
                                {{ $tipe }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ $errors->has('wilayah_id') ? 'has-error' : '' }}">
                    <label for="wilayah_id">{{ trans('id.pengajuan.tabel.wilayah') }}<span
                            class="text-danger">*</span></label>
                    <select class="form-control select {{ $errors->has('wilayah_id') ? 'is-invalid' : '' }}"
                        name="wilayah_id" id="wilayah_id" required>
                        <option value disabled {{ old('wilayah_id', null) === null ? 'selected' : '' }}>
                            {{ trans('id.silahkanPilih') }}</option>
                        @foreach (App\Models\UserManagement\Role::wilayah_select as $key => $wilayah)
                            <option value="{{ $key }}" {{ $role->wilayah_id === $key ? 'selected' : '' }}>
                                {{ $wilayah }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                    <label for="permissions">{{ trans('global.role.fields.permissions') }}*
                        <span class="btn btn-info btn-xs select-all">Select all</span>
                        <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
                    <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                        @foreach ($permissions as $id => $permissions)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('permissions', [])) || (isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                {{ $permissions }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('permissions'))
                        <p class="help-block">
                            {{ $errors->first('permissions') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.role.fields.permissions_helper') }}
                    </p>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>
        </div>
    </div>

@endsection
