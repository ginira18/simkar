@extends('admin.layout.template')

@section('title', 'Daftar Gaji Karyawan')

@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Gaji Karyawan</h4>

                <form class="mt-3 mr-5 text-end" method="GET" action="{{ route('dashboard-gaji.index') }}">
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIP"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="employee_type" class="form-control">
                                <option value="">Semua Jenis Karyawan</option>
                                <option value="monthly" {{ request('employee_type') === 'monthly' ? 'selected' : '' }}>
                                    Bulanan</option>
                                <option value="daily" {{ request('employee_type') === 'daily' ? 'selected' : '' }}>Harian
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="salary_status" class="form-control">
                                <option value="">Semua Status Gaji</option>
                                <option value="given" {{ request('salary_status') === 'given' ? 'selected' : '' }}>Gaji
                                    Sudah Diberikan</option>
                                <option value="not_given" {{ request('salary_status') === 'not_given' ? 'selected' : '' }}>
                                    Gaji Belum Diberikan</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <table class="table table-striped mt-5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Bagian</th>
                            <th>Jenis Karyawan</th>
                            <th>Status Gaji</th>
                            <th class="pl-5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->NIP }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>
                                    @if ($employee->employee_type == 'monthly')
                                        Bulanan
                                    @elseif ($employee->employee_type == 'daily')
                                        Harian
                                    @endif
                                </td>
                                <td>
                                    @if ($employee->has_salary_been_given)
                                        <span class="badge bg-success">Gaji Sudah Diberikan</span>
                                    @else
                                        <span class="badge bg-warning">Gaji Belum Diberikan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('salary.show', $employee->id) }}"
                                        class="btn btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{-- {{ $employees->links() }} --}}
                </div>
            </div>
        </div>
    </div>

@endsection
