<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <title>Document</title>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<nav class="main-header navbar navbar-expand elevation-1">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link navbar-link-item" data-widget="pushmenu" href="#" role="button"><i
                    class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/logout" class="nav-link navbar-link-item">Logout</a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <div class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/icon/logo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image"
            >
            <span class="brand-text font-weight-light">Aplikasi Sarana</span>
        </a>
        <div class="my-sidebar-menu">
            <ul class="nav nav-sidebar nav-pills flex-column">
                <nav class="mt-2 nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link">
                            <i class="fa fa-tachometer nav-icon" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header" style="padding: 0.5rem 1rem 0.5rem 1rem;">
                        Master Data
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}"
                           class="nav-link">
                            <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jurusan.index') }}"
                           class="nav-link">
                            <i class="fa fa-tags nav-icon" aria-hidden="true"></i>
                            <p>Jurusan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kelas.index') }}"
                           class="nav-link">
                            <i class="fa fa-bookmark nav-icon" aria-hidden="true"></i>
                            <p>Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mahasiswa.index') }}"
                           class="nav-link">
                            <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                            <p>Mahasiswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ruangan.index') }}"
                           class="nav-link">
                            <i class="fa fa-home nav-icon" aria-hidden="true"></i>
                            <p>Ruangan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sarana.index') }}"
                           class="nav-link">
                            <i class="fa fa-cubes nav-icon" aria-hidden="true"></i>
                            <p>Sarana</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock.index') }}"
                           class="nav-link {{ request()->is('persediaan') ? 'active' : ''}}">
                            <i class="fa fa-archive nav-icon" aria-hidden="true"></i>
                            <p>Persediaan</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('persediaan-keluar*') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{ request()->is('persediaan-keluar*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-upload"></i>
                            <p>
                                Stock Keluar
                                <i class="right fa fa-angle-down"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stock.keluar.index') }}"
                                   class="nav-link {{ request()->is('persediaan-keluar') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Permintaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.keluar.data') }}"
                                   class="nav-link {{ request()->is('persediaan-keluar/data') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Data</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('persediaan-masuk*') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{ request()->is('persediaan-masuk*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-download"></i>
                            <p>
                                Stock Masuk
                                <i class="right fa fa-angle-down"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stock.masuk.index') }}"
                                   class="nav-link {{ request()->is('persediaan-masuk') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Permintaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.masuk.data') }}"
                                   class="nav-link {{ request()->is('persediaan-masuk/data') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Data</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('keluhan*') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link {{ request()->is('keluhan*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-comments"></i>
                            <p>
                                Keluhan
                                <i class="right fa fa-angle-down"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('keluhan.index') }}"
                                   class="nav-link {{ request()->is('keluhan') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('keluhan.data') }}"
                                   class="nav-link {{ request()->is('keluhan/riwayat') ? 'active' : ''}}">
                                    <i class="fa fa-circle-o nav-icon" aria-hidden="true"></i>
                                    <p>Riwayat</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </nav>
            </ul>
        </div>
    </div>
</aside>
<div class="content-wrapper p-3">
    @yield('content-title')
    @yield('content')
</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
@yield('js')
</body>
</html>
