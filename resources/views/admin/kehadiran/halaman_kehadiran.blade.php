@extends('admin.layout.template')

@section('title', 'Dashboard Kehadiran')
@section('content')

    <div class="main-panel content-wrapper pt-0">

        <body>
            <div class="row m-0">
                <div class="card rounded mb-2 mr-2 p-4 col-md-3">
                    <label class="card-title">Selamat Datang,</label>
                    <h3>{{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}</h3>
                </div>
                <div class="card rounded mb-2 ml-2 p-4 col-md">
                    <label class="card-title">Tempelkan Kartu Pada Pembaca RFID</label>
                    <form action="{{ route('dashboard-kehadiran.store') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control col-md-5" style="border: none;" id="id_attendance"
                            name="nip_or_rf_id" autofocus>

                        {{-- @if (session('status_error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert"
                                id="status_error">
                                {{ session('status_error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}

                    </form>
                </div>
            </div>

            <div class="col-sm-12 grid-margin card rounded">
                <div class="card-body">
                    <h4 class="card-title">Daftar Kehadiran</h4>
                    {{-- <form action="{{ route('end-attendance') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Akhiri Presensi Hari Ini</button>
                    </form> --}}
                    <form action="{{ route('end-attendance') }}" method="POST">
                        @csrf
                        {{-- <button type="submit" class="btn btn-danger">Akhiri Presensi Hari Ini</button> --}}

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
                                            @if ($attendance->keterangan == 'tepat_waktu')
                                                <label class="badge badge-success">Tepat Waktu</label>
                                            @elseif($attendance->keterangan == 'terlambat')
                                                <label class="badge badge-danger">Terlambat</label>
                                            @elseif($attendance->status == 'alpha')
                                                <label class="badge badge-danger">Tidak Masuk</label>
                                            @elseif($attendance->status == 'izin')
                                                <label class="badge badge-warning">Izin</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($attendance->check_in)
                                                {{ $attendance->check_in }}
                                            @elseif ($attendance->status == 'alpha' || $attendance->status == 'izin')
                                                <h3>-</h3>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($attendance->check_out)
                                                {{ $attendance->check_out }}
                                            @elseif ($attendance->status == 'alpha' || $attendance->status == 'izin')
                                                <h3>-</h3>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </body>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content animate__animated animate__fadeIn">
                <div class="modal-body text-center">
                    <i class="icon-check text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Selamat, <strong id="employeeName"></strong> Presensi berhasil dilakukan.</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content animate__animated animate__fadeIn">
                <div class="modal-body text-center">
                    <i class=" icon-close text-danger" style="font-size: 4rem;"></i>
                    <h4 class="mt-3" id="errorMessage">Terjadi kesalahan saat memproses presensi.</h4>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status_success'))
                var employeeName = @json(session('employee_name'));
                $('#employeeName').text(employeeName);
                $('#attendanceModal').modal('show');

                setTimeout(function() {
                    $('#attendanceModal').addClass('animate__fadeOut');
                    setTimeout(function() {
                        $('#attendanceModal').modal('hide');
                        $('#attendanceModal').removeClass('animate__fadeOut');
                    }, 1000);
                }, 3000);
            @endif

            @if (session('status_error'))
                var errorMessage = @json(session('status_error'));
                $('#errorMessage').text(errorMessage);
                $('#errorModal').modal('show');

                setTimeout(function() {
                    $('#errorModal').addClass('animate__fadeOut');
                    setTimeout(function() {
                        $('#errorModal').modal('hide');
                        $('#errorModal').removeClass('animate__fadeOut');
                    }, 1000);
                }, 3000);
            @endif

            // Set focus to the input field when the modal is hidden
            $('#attendanceModal').on('hidden.bs.modal', function() {
                $('#id_attendance').focus();
            });

            $('#errorModal').on('hidden.bs.modal', function() {
                $('#id_attendance').focus();
            });
        });
    </script>

@endsection
