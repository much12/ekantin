<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-5.14.0/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables.net/1.10.22/css/bootstrap-datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>{{ isset($title) ? $title : null }}</title>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-custom fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">E-Kantin</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-black" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    {{ session('name') }}
                </a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-cog"></i>
                        Pengaturan
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="logout">
                        <i class="fa fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>

        <div class="sidebar" role="navigation">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item text-center" style="padding: 20px 0 0;">
                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" width="100">

                        <h3>{{ session('name') }}</h3>
                        <p>{{ session('role') }}</p>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard') }}">
                            <i class="fa fa-home"></i>
                            Beranda
                        </a>
                    </li>

                    @if(session('roleId') == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user') }}">
                            <i class="fa fa-users"></i>
                            Master User
                        </a>
                    </li>
                    @endif

                    @if(session('roleId') == 2)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etalase') }}">
                            <i class="fa fa-cube"></i>
                            Etalase
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('createBarang') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Tambah Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-info"></i>
                            Report
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert-2.1.2/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/1.10.22/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/1.10.22/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('script')
</body>

</html>