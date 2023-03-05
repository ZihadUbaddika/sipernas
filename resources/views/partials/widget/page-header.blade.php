<div class="card card-widget">
    <div class="widget-user-header bg-dark-green p-3">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-1 text-center my-auto">
                        <h1><i class="fas fa-@yield('icon', 'fa-bars')"></i></h1>
                    </div>
                    <div class="col-md-11">
                        <h3 class="page-site-title ml-2">@yield('title', '')</h3>
                        <h5 class="page-site-desc ml-2">@yield('desc', '-')</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right my-auto">
                <a class="btn btn-primary page-site-desc font-w500 " href="@yield('add_route', '#')">
                        <i class="fas fa-@yield('add_icon', 'circle-plus')"></i> &nbsp;@yield('add_text', '')
                </a>
            </div>
        </div>
    </div>
</div>