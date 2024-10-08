@extends('pegawai.template')

@section('title', 'Laporan Karyawan')
@section('content')
    <div class="col-sm-12 grid-margin card rounded" style="height: 100%">
        <div class="card-body">
            <div class="page-header col-md-9 mb-0">
                <h4 class="card-title">Daftar laporan</h4>
                <a class="btn btn-primary mt-5 mr-4" href="{{ route('karyawan.laporan.create') }}">Tambah Laporan</a>
            </div>
            <form class="col-md-9" method="GET" action="{{ route('laporan-karyawan') }}">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="title">Judul Laporan</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ request('title') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date">Tanggal</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="form-group col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
    
            <form>
                <div class="form-group col-md-9 pl-0 mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report->date }}</td>
                                    <td>{{ $report->title }}</td>
                                    <td>
                                        <a href="{{ route('laporan.show', ['id' => $report->id]) }}" class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $reports->links() }}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
