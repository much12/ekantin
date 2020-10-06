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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>{{ isset($title) ? $title : null }}</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

{{-- <style>
    .sidebarr {
        width: 20%;
        height: 100%;
    }

    .sidebar {
        padding-top: 50%;
    }

    .logos {
        height: 100px;
        width: 100px;
    }

    .navi {
        padding-top: 10%;
    }
</style> --}}

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-custom fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">E-Kantin</a>

        <ul class="nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    {{session('name')}}
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
    </nav>

    {{-- <aside class="sidebarr">
        <div class="sidebar text-center">
            <div class="profile-image">
                <img src="https://bnpb.go.id/uploads/organization/default.jpg" alt="" class="img-fluid img-thumbnail rounded-circle logos">
                <h6>{{session('name')}}</h6>
    </div>
    </div>
    <nav class="mt-3 navi">
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>
    </nav>
    </aside> --}}

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert-2.1.2/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>