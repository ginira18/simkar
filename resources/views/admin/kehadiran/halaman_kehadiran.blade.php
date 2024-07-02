@extends('admin.layout.template')

@section('title', 'Dashboard Kehadiran')
@section('content')

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
                    {{-- <form action="{{ route('end-attendance') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Akhiri Presensi Hari Ini</button>
                    </form> --}}
                    <form action="{{ route('end-attendance') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Akhiri Presensi Hari Ini</button>
                        
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

@endsection
