<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar')</title>
    @vite(['resources/css/app.css'])
</head>

<div class="main-panel content-wrapper">

    <body>
        <div class="row m-0">
            <div class="card rounded mb-5 mr-2 p-4 col-md-3">
                <label class="card-title">Selamat Datang,</label>
                <h3>{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</h3>
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
                                <th> keterangan</th>
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
                                    <td>
                                            <label class="badge badge-danger">Terlambat</label>
                                    </td>
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
</div>
<script src="{{ asset('./vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('./vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('./vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('./vendors/chartist/chartist.min.js') }}"></script>
@vite(['resources/js/app.js'])
{{-- <script src="{{ asset('./vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('./vendors/chartist/chartist.min.js') }}"></script> --}}  

@yield('scripts')

</html>