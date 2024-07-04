@extends('admin.layout.template')

@section('title', 'Dashboard Laporan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Laporan Karyawan</h4>
                <form action="{{ route('dashboard-laporan.index') }}" method="GET">
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
                            <th>Bagian</th>
                            <th>Tanggal Laporan</th>
                            <th>Judul Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $index => $report)
                            <tr>
                                <td>{{ $reports->firstItem() + $index }}</td> {{-- Nomor urutan di setiap halaman --}}
                                <td>{{ $report->employee->name }}</td>
                                <td>{{ $report->employee->department->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->date)->format('d-m-Y') }}</td>
                                <td>{{ $report->short_title }}</td>
                                <td>
                                    <a href="{{ route('dashboard-laporan.show', ['dashboard_laporan' => $report->id]) }}" class="btn btn-outline-primary">Detail</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex flex-row-reverse mt-3">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
