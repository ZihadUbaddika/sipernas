@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <img src="{{ asset('assets/img/logo-sipernas.png') }}" width="450">
        </div>
    </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Silahkan Login</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('global.login_email') }}" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ trans('global.login_password') }}" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group {{ $errors->has('tipe') ? 'has-error' : '' }}">
                    <label>Login Sebagai</label>
                    <select class="form-control select {{ $errors->has('tipe') ? 'is-invalid' : '' }}" name="tipe"
                        id="tipe" required>
                        <option value disabled {{ old('tipe', null) === null ? 'selected' : '' }}>
                            {{ trans('id.silahkanPilih') }}</option>
                        @foreach (App\Models\UserManagement\Role::tipe_select as $key => $tipe)
                                <option value="{{ $key }}"
                                    {{ old('tipe', '') === (string) $key ? 'selected' : '' }}>{{ $tipe }}
                                </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-8">
                        <input type="checkbox" name="remember"> {{ trans('global.remember_me') }}
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('global.login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <!-- <p class="mb-1">
                <a class="" href="{{ route('password.request') }}">
                    {{ trans('global.forgot_password') }}
                </a>
            </p> -->
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
        </div>
        <!-- /.login-card-body -->
</div>
@endsection