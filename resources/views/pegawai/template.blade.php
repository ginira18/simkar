<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar')</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo" href="index.html">
                    <img src="{{ Vite::asset('resources/images/logo-abyaz.png') }} " alt="logo" class="logo mt-3"
                        style="height: 70px;" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h3 class="mb-0 font-weight-medium d-none d-lg-flex">Sistem Manajemen Karyawan</h3>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle ml-2"
                                src="{{ Vite::asset('resources/images/faces/face8.jpg') }}" alt="Profile image">
                            <span class="font-weight-normal">
                                {{Auth::user()->employee->name }}
                            </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle"
                                    src="{{ Vite::asset('resources/images/faces/face8.jpg') }}" alt="Profile image">
                                <p class="mb-1 mt-3">Allen Moreno</p>
                                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My
                                Profile </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="dropdown-item-icon icon-power text-primary"></i>Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">
                        <span class="nav-link">@yield('title', 'Simkar')</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('dashboard-karyawan')}}">
                            <span class="menu-title">Dashboard</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('kehadiran-karyawan') }}">
                            <span class="menu-title">Kehadiran</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li> --}}
                    
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#karyawan" aria-expanded="false"
                            aria-controls="karyawan">
                            <span class="menu-title">Kehadiran</span>
                            <i class="icon-layers menu-icon"></i>
                        </a>
                        <div class="collapse" id="karyawan">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('kehadiran-karyawan') }}">Data Kehadiran</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route ('izin-karyawan')}}">Ajukan Izin</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <span class="menu-title">Laporan Harian</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <span class="menu-title">Gaji</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li>
                </ul>

                
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                    {{-- <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                2024</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> </span>
                        </div>
                    </footer> --}}
                </div>
                <!-- end main content -->
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>



    <script src="{{ asset('./vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('./vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('./vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('./vendors/chartist/chartist.min.js') }}"></script>
    @vite(['resources/js/app.js'])
    {{-- <script src="{{ asset('./vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('./vendors/chartist/chartist.min.js') }}"></script> --}}

    @yield('scripts')

</body>

</html>
