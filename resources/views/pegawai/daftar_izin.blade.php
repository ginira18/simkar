@extends('pegawai.template')

@section('title', 'Kehadiran Karyawan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded" style="height: 100%">
        <div class="card-body">
            <div class="page-header col-md-10">
                <h4 class="card-title">Daftar Izin</h4>
                <a class="btn btn-warning mt-5 mr-4" href='{{ route('izin-karyawan-create') }}'>Ajukan Izin</a>
            </div>
            <form method="GET" action="{{ route('izin-karyawan') }}" class="mt-4">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date">Tanggal</label>
                        <input type="date" id="date" name="date" class="form-control"
                            value="{{ $selectedDate }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="Pending" {{ $selectedStatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $selectedStatus == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $selectedStatus == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <form>
                <div class="form-group col-md-10 pl-0 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->start_date }}</td>
                                    <td>{{ $permission->end_date }}</td>
                                    <td>
                                        @if ($permission->status == 'Pending')
                                            <label class="badge badge-warning">{{ $permission->status }}</label>
                                        @elseif($permission->status == 'Approved')
                                            <label class="badge badge-success">{{ $permission->status }}</label>
                                        @elseif($permission->status == 'Rejected')
                                            <label class="badge badge-danger">{{ $permission->status }}</label>
                                        @else
                                            <label class="badge badge-secondary">{{ $permission->status }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-primary btn-sm btn-icon-text"
                                            href="{{ route('izin.detail', $permission->id) }}">
                                            <i class="icon-info btn-icon-prepend"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

@endsection
