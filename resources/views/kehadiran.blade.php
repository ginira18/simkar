<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar')</title>
    @vite(['resources/css/app.css'])
</head>

<div class="main-panel content-wrapper">
        <div class="row m-0">
            <div class="card rounded mb-5 mr-2 p-4 col-md-3">
                <label class="card-title">Selamat Datang,</label>
                <h3>Selasa 02 Mei 2024</h3>
            </div>
            {{-- <div class="col-md-2"></div> --}}
            <div class="card rounded mb-5"> 

        <body>
            <div class="row m-0">
                <div class="card rounded mb-5 mr-2 p-4 col-md-3">
                    <label class="card-title">Selamat Datang,</label>
                    <h3>Selasa 02 Mei 2024</h3>
                </div>
                <div class="card rounded mb-5 ml-2 p-4 col-md">
                    <label class="card-title">Tempelkan Kartu Pada Pembaca RFID</label>
                    <form action="{{ route('dashboard-kehadiran.store') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control col-md-5" style="border: none;" id="id_attendance"
                            name="nip_or_rf_id" autofocus>
                        @if (session('status_error'))
                            <div class="alert alert-danger">
                                {{ session('status_error') }}
                            </div>
                        @endif
                        @if (session('status_success'))
                            <div class="alert alert-success">
                                {{ session('status_success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-sm-12 grid-margin card rounded">
                <div class="card-body">
                    <h4 class="card-title">Daftar Kehadiran</h4>
                    <form>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama </th>
                                    <th> NIP </th>
                                    <th> Bagian </th>
                                    <th> Status</th>
                                    <th> Datang </th>
                                    <th> Pulang </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        <td>{{ $attendance->employee->NIP }}</td>
                                        <td>{{ $attendance->employee->department->name }}</td>
                                        <td><label class="badge badge-danger">Terlambat</label></td>
                                        <td>{{ $attendance->check_in }}</td>
                                        <td>{{ $attendance->check_out }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </body>
    </div>ml-2 p-4 col-md">
                <label class="card-title">Tempelkan Kartu Pada Pembaca RFID</label>
                {{-- <input type="text" class="form-control col-md-5"> --}}
                <input type="text" class="form-control col-md-5" style="border: none;" autofocus>
            </div>
        </div>
    
        <div class="col-sm-12 grid-margin card rounded">
            <div class="card-body">
                <h4 class="card-title">Daftar Kehadiran</h4>
                <form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIP </th>
                                <th> Bagian </th>
                                <th> Status</th>
                                <th> Jam Kehadiran </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Gilang Nico Raharjo </td>
                                    <td>1234565432</td>
                                    <td>Marketing</td>
                                    <td><label class="badge badge-danger">Terlambat</label></td>
                                    <td>00.00</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    
        {{-- modal RFID --}}
        <div class="modal fade" id="RFID" tabindex="-1" role="dialog" aria-labelledby="RFID" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="text-align: center">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah RFID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="mb-2">
                                <label>
                                    <h5>Tempelkan Kartu Pada Pembaca RFID</h5>
                                </label>
                                <input type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
</div>

</html>