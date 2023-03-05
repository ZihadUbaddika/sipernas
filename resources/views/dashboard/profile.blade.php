@extends('layouts.main')
@section('title', trans('id.kepegawaian.judul_singular'))
@section('desc', trans('id.kepegawaian.deskripsi'))
@section('icon', 'user-circle')
@section('add_text', trans('id.kembali'))
@section('add_icon', 'arrow-left')
@section('content')
    @include('partials.widget.page-header')
    <div class="card">
        <div class="card-header">
            Profil Saya
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th rowspan="3" width="100">
                            <img src="{{ asset('profile_photo/'. $kepegawaian->foto) }}" alt="AdminLTE Logo"
                            width="150" class="brand-image rounded elevation-3" style="opacity: .8">
                        </th>
                        <td>
                            {{ $kepegawaian->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $kepegawaian->nip ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $kepegawaian->pangkat ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.kepegawaian.tabel.golongan') }}
                        </th>
                        <td>
                            {{ $kepegawaian->golongan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.kepegawaian.tabel.email') }}
                        </th>
                        <td>
                            {{ $kepegawaian->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('id.kepegawaian.tabel.no_hp') }}
                        </th>
                        <td>
                            {{ $kepegawaian->no_hp ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
