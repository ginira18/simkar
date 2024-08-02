@extends('admin.layout.template')

@section('title', 'Daftar Rekap')
@section('content')

@php
    use Carbon\Carbon;
@endphp
    <div class="col-sm-9 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rekap Karyawan</h4>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryHistories as $index => $salaryHistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ Carbon::parse($salaryHistory->month)->locale('id')->translatedFormat('F Y') }}</td>
                                <td>Rp. {{ number_format($salaryHistory->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('detail-rekap', $salaryHistory->month) }}" class="btn btn-primary btn-sm">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
