@extends('layouts.main')
@section('title', trans('id.user.judul'))
@section('desc', trans('id.user.deskripsi'))
@section('icon', 'user-shield')
@section('add_route', route('dashboard.admin.users_management.users.create'))
@section('add_text', trans('id.tambah'))
@section('content')
@include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            {{ trans('id.daftar') }} {{ trans('id.user.judul_singular') }}
        </div>

        <div class="card-body">
                <table id="example1" class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('id.user.tabel.username') }}
                            </th>
                            <th>
                                {{ trans('id.user.tabel.email') }}
                            </th>
                            <th>
                                {{ trans('id.user.tabel.roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration ?? '' }}
                                </td>
                                <td>
                                    {{ $user->kepegawaian->nama ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    @foreach ($user->roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td width="110" class="text-center">
                                    @can('user_show')
                                        <a class="btn btn-sm btn-primary" href="{{ route('dashboard.admin.users_management.users.show', $user->id) }}">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>
                                    @endcan
                                    @can('user_edit')
                                        <a class="btn btn-sm btn-warning" href="{{ route('dashboard.admin.users_management.users.edit', $user->id) }}">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    @endcan
                                    <!-- @can('user_delete')
                                        <form action="{{ route('dashboard.admin.users_management.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('id.andaYakin') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                        </form>
                                    @endcan -->
                                    @can('user_delete')
                                            <form
                                                action="{{ route('dashboard.admin.users_management.users.destroy', $user->id) }}"
                                                method="POST" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token"
                                                    value="{{ csrf_token() }}">
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal_{{ $user->id }}">
                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                                        <div class="modal fade" id="delete-modal_{{ $user->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            {{ trans('id.hapus') . ' ' . trans('Data User') }}
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ trans('id.andaYakin') }}</p>
                                                                    </div>
                                                                <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">{{ trans('id.tidak') }}</button>
                                                                <button type="submit"
                                                                class="btn btn-danger">{{ trans('id.ya') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
