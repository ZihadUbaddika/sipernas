<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.pegawai.home') }}" class="brand-link">
        <img src="{{ asset('assets/img/logo-lampung.png') }}" alt="dashboardLTE Logo" class="brand-image">
        <span class="brand-text font-weight-bold">{{ trans('global.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.home') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt">

                        </i>
                        <p>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li
                        class="nav-item has-treeview {{ request()->is('dashboard/users_management/permissions*') ? 'menu-open' : '' }} {{ request()->is('dashboard/users_management/roles*') ? 'menu-open' : '' }} {{ request()->is('dashboard/users_management/users*') ? 'menu-open' : '' }}{{ request()->is('dashboard/users_management/staff*') ? 'menu-open' : '' }}{{ request()->is('dashboard/users_management/kepegawaians*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="nav-icon fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('global.userManagement.title') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.users_management.permissions.index') }}"
                                        class="nav-link {{ request()->is('dashboard/users_management/permissions') || request()->is('dashboard/users_management/permissions/*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.users_management.roles.index') }}"
                                        class="nav-link {{ request()->is('dashboard/users_management/roles') || request()->is('dashboard/users_management/roles/*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.users_management.users.index') }}"
                                        class="nav-link {{ request()->is('dashboard/users_management/users') || request()->is('dashboard/users_management/users/*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-shield">

                                        </i>
                                        <p>
                                            <span>{{ trans('global.user_management.users') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('kepegawaian_access')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.admin.users_management.kepegawaians.index') }}"
                            class="nav-link {{ request()->is('dashboard/admin/users_management/kepegawaians') || request()->is('dashboard/admin/users_management/kepegawaians/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                <span>{{ trans('id.kepegawaian.judul') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('pengajuan_access')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.pengajuans.index') }}"
                            class="nav-link {{ request()->is('dashboard/pengajuans') || request()->is('dashboard/pengajuans/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list">

                            </i>
                            <p>
                                <span>{{ trans('id.pengajuan.judul_singular') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @if(Gate::check('is_irban') || Gate::check('is_inspektur') || Gate::check('pengajuan_create'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard.spts.spt_terbit') }}"
                            class="nav-link {{ request()->is('dashboard/spts') || request()->is('dashboard/spts/*') || request()->is('dashboard/spts_terbit') || request()->is('dashboard/spts_terbit/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list">
                            </i>
                            <p>
                                <span>{{ trans('id.pengajuan.spt_terbit_singular') }}</span>
                            </p>
                        </a>
                    </li>
                @endif
                @if(Gate::check('spt_access') && Gate::check('spt_create'))
                    <li
                        class="nav-item has-treeview {{ ((((request()->is('dashboard/spts_terbit') ? 'menu-open' : '' || request()->is('dashboard/spts_terbit/*')) ? 'menu-open' : '' || request()->is('dashboard/spts_tertunda')) ? 'menu-open' : '' || request()->is('dashboard/spts_tertunda/*')) ? 'menu-open' : '' || request()->is('dashboard/spts/*')) ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle">
                            <i class="nav-icon fas fa-file-signature">

                            </i>
                            <p>
                                <span>{{ trans('id.pengajuan.spt_singular') }}</span>
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.spts.spt_terbit') }}"
                                    class="nav-link {{ request()->is('dashboard/spts_terbit') || request()->is('dashboard/spts_terbit/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-signature">

                                    </i>
                                    <p>
                                        <span>{{ trans('id.pengajuan.spt_terbit_singular') }}</span> <span
                                            class="badge bg-primary right">{{ App\Models\Pengajuan::where('status_pengajuan', 'disetujui_inspektur')->where('no_spt', '!=', null)->select('id', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.spts.spt_tertunda') }}"
                                    class="nav-link {{ (request()->is('dashboard/spts_tertunda') || request()->is('dashboard/spts_tertunda/*') ? 'active' : '' || request()->is('dashboard/spts/*')) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file">

                                    </i>
                                    <p>
                                        <span>{{ trans('id.pengajuan.spt_tertunda_singular') }}</span> <span
                                            class="badge bg-primary right">{{ App\Models\Pengajuan::where('status_pengajuan', 'disetujui_inspektur')->where('no_spt', '=', null)->select('id', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @can('programkegiatan_access')
                <li class="nav-item">
                    <a href="{{ route('dashboard.programkegiatans.index') }}"
                        class="nav-link {{ request()->is('dashboard/programkegiatans') || request()->is('dashboard/programkegiatans/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list">

                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.programkegiatan_singular') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('programkegiatan_access')
                <li class="nav-item">
                    <a href="{{ route('dashboard.riwayatkegiatans.index') }}"
                        class="nav-link {{ request()->is('dashboard/riwayatkegiatans') || request()->is('dashboard/riwayatkegiatans/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-business-time">

                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.riwayatkegiatan_singular') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
