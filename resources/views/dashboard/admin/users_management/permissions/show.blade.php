@extends('layouts.main')
@section('title', 'Permission')
@section('desc', 'Lihat Detail Permission')
@section('icon', 'unlock-alt')
@section('add_route', route('dashboard.admin.users_management.permissions.index'))
@section('add_text', trans('global.back'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.permission.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.permission.fields.title') }}
                    </th>
                    <td>
                        {{ $permission->title }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection