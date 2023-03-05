@extends('layouts.main')
@section('title', 'Permission')
@section('desc', 'Manajemen Permission')
@section('icon', 'briefcase')
@section('add_route', route('dashboard.admin.users_management.permissions.create'))
@section('add_text', trans('global.add'))
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('global.permission.title_singular') }}
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.permission.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td class="text-center">
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                            <td width="110" class="text-center">
                                @can('permission_show')
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('dashboard.admin.users_management.permissions.show', $permission->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('permission_edit')
                                    <a class="btn btn-sm btn-warning"
                                        href="{{ route('dashboard.admin.users_management.permissions.edit', $permission->id) }}">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                @can('permission_delete')
                                    <form action="{{ route('dashboard.admin.users_management.permissions.destroy', $permission->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
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
