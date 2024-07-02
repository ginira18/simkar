@extends('admin.layout.template')

@section('title', 'Riwayat Kehadiran')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Kehadiran</h4>
                <form action="{{ route('riwayat-kehadiran') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mt-5 ml-auto">
                            <input type="search" class="form-control" name="search" placeholder="Cari sesuatu ..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2 mt-5">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Bagian</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $index => $attendance)
                            <tr>
                                <td>{{ $attendances->firstItem() + $index }}</td>
                                <td>{{ $attendance->employee->name }}</td>
                                <td>{{ $attendance->employee->NIP }}</td>
                                <td>{{ $attendance->employee->department->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                                {{-- <td>{{ $attendance->keterangan ?? '-' }}</td> --}}
                                <td>
                                    @if ($attendance->keterangan == 'tepat_waktu')
                                        <label class="badge badge-success">Tepat Waktu</label>
                                    @elseif($attendance->keterangan == 'terlambat')
                                        <label class="badge badge-danger">Terlambat</label>
                                        @elseif($attendance->status == 'izin' || $attendance->status == 'alpha')
                                        <h3>-</h3>
                                    @endif
                                </td>
                                <td>
                                    @if ($attendance->status == 'hadir')
                                        <label class="badge badge-success">Hadir</label>
                                    @elseif($attendance->status == 'izin')
                                        <label class="badge badge-warning">Izin</label>
                                    @elseif($attendance->status == 'alpha')
                                        <label class="badge badge-danger">Tidak Masuk</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               <div class="d-flex flex-row-reverse mt-3"> {{ $attendances->links() }}</div>
            </div>
        </div>
    </div>
@endsection
