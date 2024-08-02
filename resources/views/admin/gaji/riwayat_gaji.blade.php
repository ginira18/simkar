@extends('admin.layout.template')

@section('title', 'Riwayat Gaji')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h4 class="card-title">Daftar Riwayat Gaji Karyawan</h4>
                <form action="{{ route('dashboard-riwayat_gaji') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <input type="search" class="form-control" name="search"
                                placeholder="Cari nama, NIP, atau bagian..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="month">
                                <option value="">-- Pilih Bulan --</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="year">
                                <option value="">-- Pilih Tahun --</option>
                                @for ($year = 2020; $year <= now()->year; $year++)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <table class="table table-striped mt-5">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> NIP </th>
                            <th> Bagian </th>
                            <th> Total Diberikan </th>
                            <th> Tanggal Gaji </th>
                            <th class="pl-5"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryHistories as $salaryHistory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $salaryHistory->employee->name }}</td>
                                <td>{{ $salaryHistory->employee->NIP }}</td>
                                <td>{{ $salaryHistory->employee->department->name }}</td>
                                <td>Rp. {{ number_format($salaryHistory->total_salary, 0, ',', '.') }}</td>
                                <td>{{ $salaryHistory->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('history_salary.show', $salaryHistory->id) }}" class="btn btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-end">
                    {{ $salaryHistories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
