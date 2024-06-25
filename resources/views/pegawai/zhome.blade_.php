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
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h3 class="mb-0 font-weight-medium d-none d-lg-flex">Sistem Manajemen Karyawan</h3>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle ml-2"
                                src="{{ Vite::asset('resources/images/faces/face8.jpg') }}" alt="Profile image">
                            <span class="font-weight-normal"> Henry Klein </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle"
                                    src="{{ Vite::asset('resources/images/faces/face8.jpg') }}" alt="Profile image">
                                <p class="mb-1 mt-3">Allen Moreno</p>
                                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My
                                Profile </a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign
                                Out</a>
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
            <div class="main-panel" style="width: 100%">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="card col-md-4 rounded pl-5 pt-3 mr-5 ml-2 ">
                            <label class="card-title">Selamat Datang,</label>
                            <h2>Gilang Nico Raharjo</h2>
                        </div>
                        <div class="card col-md-7 rounded pl-5 pt-3 ml-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="card-title ml-3">NIP : </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="card-title ml-3">Jenis Karyawan : </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="card-title ml-3">Bagian : </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="card-title ml-3">Status Karyawan : </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="card-title ml-3">Jabatan : </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row quick-action-toolbar">
                        <div class="col-md-12 grid-margin mt-5">
                          <div class="card">
                            <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                              <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                <button type="button" class="btn px-0"> <i class="icon-user mr-2"></i> Catatan Kehadiran</button>
                              </div>
                              <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                <button type="button" class="btn px-0"><i class="icon-docs mr-2"></i> Izin</button>
                              </div>
                              <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                <button type="button" class="btn px-0"><i class="icon-folder mr-2"></i> Laporan Harian</button>
                              </div>
                              <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                <button type="button" class="btn px-0"><i class="icon-book-open mr-2"></i>Gaji</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
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
