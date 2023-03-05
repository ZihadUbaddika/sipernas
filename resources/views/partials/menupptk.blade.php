<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.pptk.home') }}" class="brand-link">
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
                    <a href="{{ route('dashboard.pptk.home') }}"
                        class="nav-link {{ request()->is('dashboard/pptk') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt">

                        </i>
                        <p>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                    <li
                        class="nav-item has-treeview {{ ((((request()->is('dashboard/pptk/spts_terbit') ? 'menu-open' : '' || request()->is('dashboard/pptk/spts_terbit/*')) ? 'menu-open' : '' || request()->is('dashboard/pptk/spts_tertunda')) ? 'menu-open' : '' || request()->is('dashboard/pptk/spts_tertunda/*')) ? 'menu-open' : '' || request()->is('dashboard/spts/*')) ? 'menu-open' : '' }}">
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
                                <a href="{{ route('dashboard.pptk.spts.spt_terbit') }}"
                                    class="nav-link {{ request()->is('dashboard/pptk/spts_terbit') || request()->is('dashboard/pptk/spts_terbit/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-signature">

                                    </i>
                                    <p>
                                        <span>{{ trans('id.pengajuan.spt_terbit_singular') }}</span> <span
                                            class="badge bg-primary right">{{ App\Models\Pengajuan::where('status_pengajuan', 'disetujui_inspektur')->where('no_spt', '!=', null)->select('id', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.pptk.spts.spt_tertunda') }}"
                                    class="nav-link {{ (request()->is('dashboard/pptk/spts_tertunda') || request()->is('dashboard/pptk/spts_tertunda/*') ? 'active' : '' || request()->is('dashboard/spts/*')) ? 'active' : '' }}">
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
