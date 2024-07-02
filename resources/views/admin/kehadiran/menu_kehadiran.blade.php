@extends('admin.layout.template')

@section('title', 'Kehadiran')
@section('content')

    <div class="d-md-flex row m-2 quick-action-btns" role="group">
        <a class="btn btn-success col-md-3 m-5 p-3 text-center" href='{{ route('dashboard-kehadiran.create') }}'> <i
                class="icon-check mr-2"></i> Kehadiran</a>
        <a class="btn btn-warning col-md-3 m-5 p-3 text-center" href='{{ route('dashboard-izin') }}'> <i
                class="icon-envelope-letter mr-2"></i> Permintaan Izin</a>
        <a class="btn btn-primary col-md-3 m-5 p-3 text-center" href='{{ route ('riwayat-kehadiran')}}'> <i
                class="icon-notebook mr-2"></i> Riwayat Kehadiran</a>

    </div>

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title">Daftar Kehadiran Hari Ini</h4>
            <form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> NIP </th>
                            <th> Bagian </th>
                            <th> Keterangan</th>
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

@endsection
