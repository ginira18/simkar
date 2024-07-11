@extends('admin.layout.template')

@section('title', 'Detail Rekap')
@section('content')

@php
    use Carbon\Carbon;
@endphp

<div class="col-sm-9 grid-margin card rounded">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Detail Rekap Karyawan Bulan {{ Carbon::parse($month)->format('F Y') }}</h4>
            <div class="main">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Total Gaji Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryHistories as $index => $salaryHistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $salaryHistory->employee->name }}</td>
                                <td>{{ $salaryHistory->employee->NIP }}</td>
                                <td>{{ $salaryHistory->employee->department->name }}</td>
                                <td>{{ $salaryHistory->employee->position }}</td>
                                <td>Rp. {{ number_format($salaryHistory->total_salary, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a class="btn btn-secondary" href="{{ route('dashboard.rekap') }}">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('dashboard-laporan.exportCsv', $month) }}" class="btn btn-success">
                    <i class="fas fa-file-csv"></i> Ekspor ke CSV
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
