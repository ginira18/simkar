@extends('admin.layout.template')

@section('title', 'Izin')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Izin Karyawan</h4>

                <form action="{{ route('dashboard-izin') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3  ml-auto">
                            <input type="search" class="form-control" name="search" placeholder="Cari nama karyawan ..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <div class="form-group col-md-12 pl-0 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration + $permissions->firstItem() - 1 }}</td>
                                    <td>{{ $permission->employee->name }}</td>
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
                                            href="{{ route('detail-izin-admin', $permission->id) }}">
                                            <i class="icon-info btn-icon-prepend"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('dashboard-kehadiran.index') }}" class="btn btn-secondary">Kembali</a>

                    <div class="pagination">
                        {{ $permissions->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
