@extends('admin.layout.template')

@section('title', 'Karyawan')
@section('content')
    <div class="m-1">
        <div class="card rounded justify-content">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h4 class="card-title ml-4">Daftar Karyawan</h4>
                <a class="btn btn-primary mt-4 mr-4" href='{{ route('karyawan.create') }}'>Tambah Karyawan</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div>
                <form action="{{ route('karyawan.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mt-2 ml-auto">
                            <input type="search" class="form-control" name="search" placeholder="Cari sesuatu ..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-border table-hover">
                <thead>
                    <tr class="text-center">
                        <th class="py-4 font-weight-bold">No</th>
                        <th class="py-4 font-weight-bold">Nama</th>
                        <th class="py-4 font-weight-bold">NIP</th>
                        <th class="py-4 font-weight-bold">Bagian</th>
                        <th class="py-4 font-weight-bold">Jabatan</th>
                        <th class="py-4 font-weight-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($activeEmployees as $employee)
                        <tr>
                            <td>{{ $loop->iteration + ($activeEmployees->currentPage() - 1) * $activeEmployees->perPage() }}
                            </td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->NIP }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>
                                <a type="button" class="btn btn-primary btn-icon-text"
                                    href="{{ route('karyawan.show', $employee->id) }}">
                                    <i class="icon-info btn-icon-prepend"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mr-5 mt-3">
                {{ $activeEmployees->links() }}
            </div>
        </div>
    </div>
@endsection
