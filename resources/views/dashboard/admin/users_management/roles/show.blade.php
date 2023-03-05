@extends('layouts.main')
@section('title', 'Roles')
@section('desc', 'Detail Role')
@section('icon', 'briefcase')
@section('add_route', route('dashboard.admin.users_management.roles.index'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.role.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.role.fields.title') }}
                    </th>
                    <td>
                        {{ $role->title ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.role.fields.tipe') }}
                    </th>
                    <td>
                        {{ App\Models\UserManagement\Role::tipe_select[$role->tipe] ?? ''}}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.role.fields.wilayah') }}
                    </th>
                    <td>
                        {{ $role->wilayah->wilayah ?? ''}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Permissions
                    </th>
                    <td>
                        @foreach($role->permissions as $id => $permissions)
                            <span class="label label-info label-many">{{ $permissions->title }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection