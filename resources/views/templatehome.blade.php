<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sipernas</title>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-lampung.png') }}">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="{{ asset('dist/css/styles.css') }}" />
    </head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    @yield('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img alt="Brand" src="{{ asset('assets/img/logo-lampung.png') }}" width="40" height="50">  Inspektorat
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tentang Kami
                            </a>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="/tupoksi">Tugas Dan Fungsi</a></li>
                                <li><a class="dropdown-item" href="/struktur">Struktur Organisasi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Informasi Publik
                            </a>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/download/all">Peraturan-Peraturan</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/download/all">Informasi Berkala</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/download/all">Informasi Serta Merta</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/download/all">Informasi Setiap Saat</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/download/all">Lap. Permohonan Informasi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Berita
                            </a>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/post/berita">Berita</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/post/artikel">Artikel</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/post/kegiatan">Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dokumen
                            </a>
                            <ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/uploads/renstra_revisi_inspektorat_prov_lampung_2019-2024.pdf">Renstra</a></li>
                                <li><a class="dropdown-item" href="https://inspektorat.lampungprov.go.id/uploads/renja_22_new.pdf">Renja 2022</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="btn-nav"><a class="btn btn-light btn-small navbar-btn" href="/login">Login</a>
                            </div>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>

    <footer class="footer text-center bg-primary">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                         <div>
                            <p style="float: left;"><img src="{{ asset('assets/img/logo-lampung.png') }}" width="80" height="110">
                            <h4 class="text-uppercase mb-4">Inspektorat Provinsi Lampung</h4>
                        </div>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Ikuti Kami</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Hubungi Kami</h4>
                        <p class="lead mb-0">
                            <p class="m-0 pl-10 pr-10"><i class="fa fa-map-marker"></i> <a class="text-white">Jl. Dr. Susilo No. 42 Bandar Lampung 35213</a></p>
                            <p class="m-0 pl-10 pr-10"><i class="fa fa-phone"></i> <a class="text-white">(0721) 252332, 253729, 252960</a></p>
                            <p class="m-0 pl-10 pr-10"><i class="fa fa-envelope"></i> <a class="text-white" >Inspektorat@lampungprov.go.id</a></p>
                            <p class="m-0 pl-10 pr-10"><i class="fa fa-globe"></i> <a class="text-white">https://inspektorat.lampungprov.go.id</a></p>
                        </p>
                    </div>
                </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('dist/js/scripts.js') }}"></script>
</body>

</html>