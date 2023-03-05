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
                        class="nav-item has-treeview {{ request()->is('dashboard/admin/users_management/permissions*') ? 'menu-open' : '' }} {{ request()->is('dashboard/admin/users_management/roles*') ? 'menu-open' : '' }} {{ request()->is('dashboard/admin/users_management/users*') ? 'menu-open' : '' }}{{ request()->is('dashboard/admin/users_management/staff*') ? 'menu-open' : '' }}{{ request()->is('dashboard/admin/users_management/kepegawaians*') ? 'menu-open' : '' }}">
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
                                    <a href="{{ route('dashboard.admin.users_management.permissions.index') }}"
                                        class="nav-link {{ request()->is('dashboard/admin/users_management/permissions') || request()->is('dashboard/admin/users_management/permissions/*') ? 'active' : '' }}">
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
                                    <a href="{{ route('dashboard.admin.users_management.roles.index') }}"
                                        class="nav-link {{ request()->is('dashboard/admin/users_management/roles') || request()->is('dashboard/admin/users_management/roles/*') ? 'active' : '' }}">
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
                                    <a href="{{ route('dashboard.admin.users_management.users.index') }}"
                                        class="nav-link {{ request()->is('dashboard/admin/users_management/users') || request()->is('dashboard/admin/users_management/users/*') ? 'active' : '' }}">
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
