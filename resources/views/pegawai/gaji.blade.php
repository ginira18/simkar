@extends('pegawai.template')

@section('title', 'Gaji Karyawan')
@section('content')

<div class="col-sm-12 grid-margin card rounded">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Gaji Karyawan</h4>
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Total Gaji</th>
                        <th class="pl-5">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaryHistories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('F Y') }}</td>
                            <td>Rp. {{ number_format($history->total_salary, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('detail-gaji-karyawan', $history->id) }}" class="btn btn-outline-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
