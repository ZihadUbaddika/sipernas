@extends('layouts.main')
@section('title', 'Permission')
@section('desc', 'Ubah Data Permission')
@section('icon', 'unlock-alt')
@section('add_route', route('dashboard.admin.users_management.permissions.index'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.permission.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("dashboard.admin.users_management.permissions.update", [$permission->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('global.permission.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection