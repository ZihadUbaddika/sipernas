<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>@yield('title') | {{ trans('global.site_title') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-lampung.png') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/Chart.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition layout-fixed" style="height: auto;">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">About</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Documentation</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            @if (count(config('panel.available_languages', [])) > 1)
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item"
                                    href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                    ({{ $langName }})</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav ml-auto">
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link rounded bg-info elevation-2" data-toggle="dropdown" href="#">
                        {{ Auth::user()->kepegawaian->nama }}&nbsp;<i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Profile Image -->
                        <div class="card-primary card-outline card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('profile_photo/' . Auth::user()->kepegawaian->foto) }} "
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->kepegawaian->nama }}</h3>
                            <p class="text-muted text-center">Loged in as
                                @foreach (Auth::user()->roles as $roles)
                                    <span class="badge badge-warning">{{ $roles->title }}</span>
                                @endforeach
                            </p>
                        </div>
                        <div class="card-footer box-profile">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="{{route('dashboard.admin.profile_saya',Auth::user()->kepegawaian->id)}}" class="btn btn-primary">
                                        <i class="nav-icon fas fa-user">

                                        </i>
                                        <b>Profil</b>
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="#" class="btn btn-danger"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        <i class="nav-icon fas fa-sign-out-alt">

                                        </i>
                                        <span>{{ trans('global.logout') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </li>
            </ul>
        </nav>
        @if(Gate::check('user_management_access'))
            @include('partials.menuadmin')
        @elseif(Gate::check('is_pegawai'))
            @include('partials.menupegawai')
        @elseif (Gate::check('is_inspektur'))
            @include('partials.menuinspektur')
        @elseif (Gate::check('is_pptk'))
            @include('partials.menupptk')
        @elseif (Gate::check('is_irban'))
            @include('partials.menuirban')
        @endif
        <div class="content-wrapper" style="min-height: 917px;">
            <!-- Content Header (Page header) -->
            @if ($title ?? '')
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">{{ $title ?? '' }}</h1>
                            </div><!-- /.col -->
                            {{-- <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                  </ol>
                </div><!-- /.col --> --}}
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            @endif
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content mt-2">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        <!-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0-alpha
            </div>
            <strong> &copy;</strong> {{ trans('global.allRightsReserved') }}
        </footer> -->
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Config -->
    <script src="{{ asset('dist/js/config/main.js') }}"></script>
    <script src="{{ asset('dist/js/config/select2.js') }}"></script>
    <script src="{{ asset('dist/js/config/dataTables.js') }}"></script>
    <script src="{{ asset('dist/js/config/sweetalert2.js') }}"></script>
    @yield('scripts')
    @if (Session::has('message'))
        <script>
            var alert_type = "{{ Session::get('alert-type', 'info') }}";
            var type = "{{ Session::get('type', 'masuk') }}";
            switch (alert_type) {
                case 'info':
                    Toast.fire({
                        icon: "ifo",
                        title: "Info<br>Data berhasil " + type,
                    });
                    break;
                case 'warning':
                    Toast.fire({
                        icon: "warning",
                        title: "Peringatan<br>Data berhasil " + type,
                    });
                    break;
                case 'success':
                    Toast.fire({
                        icon: "success",
                        title: "Sukses<br>Data berhasil " + type,
                    });
                    break;
                case 'error':
                    Toast.fire({
                        icon: "error",
                        title: "Error<br>Data berhasil " + type,
                    });
                    break;
            }
        </script>
    @endif
</body>

</html>
