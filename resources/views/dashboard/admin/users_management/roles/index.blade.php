@extends('layouts.main')
@section('title', 'Roles')
@section('desc', 'Manajemen Roles')
@section('icon', 'briefcase')
@section('add_route', route('dashboard.admin.users_management.roles.create'))
@section('add_text', trans('global.add'))
@section('content')
@include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('global.role.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
            <table id="example1" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.role.fields.title') }}
                        </th>
                        <th>
                            {{ trans('global.role.fields.tipe') }}
                        </th>
                        <th>
                            {{ trans('global.role.fields.wilayah') }}
                        </th>
                        <th>
                            {{ trans('global.role.fields.permissions') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td class="text-center">
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{ $role->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UserManagement\Role::tipe_select[$role->tipe] ?? '' }}
                            </td>
                            <td>
                                {{ $role->wilayah->wilayah ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td width="110" class="text-center">
                                @can('role_show')
                                    <a class="btn btn-sm btn-primary" href="{{ route('dashboard.admin.users_management.roles.show', $role->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('role_edit')
                                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.admin.users_management.roles.edit', $role->id) }}">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                @can('role_delete')
                                    <form action="{{ route('dashboard.admin.users_management.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
@endsection