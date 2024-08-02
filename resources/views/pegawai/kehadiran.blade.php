@extends('pegawai.template')

@section('title', 'Kehadiran Karyawan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded" style="height: 100%">
        <div class="card-body">
            <div class="page-header">
                <h4 class="card-title">Data Kehadiran</h4>
            </div>
            <form method="GET" action="{{ route('kehadiran-karyawan') }}">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="month">Bulan</label>
                        <select id="month" name="month" class="form-control">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}"
                                    {{ $i == request('month', now()->month) ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="year">Tahun</label>
                        <select id="year" name="year" class="form-control">
                            @for ($i = now()->year - 5; $i <= now()->year; $i++)
                                <option value="{{ $i }}"
                                    {{ $i == request('year', now()->year) ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <form>
                <div class="form-group col-md-5 pl-0 mt-4">
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Tanggal </th>
                            <th> Status Kehadiran</th>
                            <th> Datang </th>
                            <th> Pulang </th>
                            <th> Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>
                                    @if ($attendance->status == 'hadir')
                                        <label class="badge badge-success">Hadir</label>
                                    @elseif($attendance->status == 'alpha')
                                        <label class="badge badge-danger">Tidak Hadir</label>
                                    @elseif($attendance->status == 'izin')
                                        <label class="badge badge-warning">Izin</label>
                                    @endif
                                </td>
                                <td>
                                    @if ($attendance->check_in)
                                        {{ $attendance->check_in }}
                                    @elseif($attendance->status == 'alpha')
                                        <label>-</label>
                                    @elseif($attendance->status == 'izin')
                                        <label>-</label>
                                    @endif
                                </td>
                                <td>
                                    @if ($attendance->check_out)
                                        {{ $attendance->check_out }}
                                    @elseif($attendance->status == 'alpha')
                                        <label>-</label>
                                    @elseif($attendance->status == 'izin')
                                        <label>-</label>
                                    @endif
                                </td>
                                <td>
                                    @if ($attendance->keterangan == 'tepat_waktu')
                                        <label class="badge badge-success">Tepat Waktu</label>
                                    @elseif($attendance->keterangan == 'terlambat')
                                        <label class="badge badge-danger">Terlambat</label>
                                    @elseif($attendance->status == 'alpha')
                                        <label>-</label>
                                    @elseif($attendance->status == 'izin')
                                        <label>-</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-end">
                    {{ $attendances->links() }}
                </div>
            </form>
        </div>
    </div>
@endsection
