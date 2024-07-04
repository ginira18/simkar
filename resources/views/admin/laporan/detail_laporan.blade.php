@extends('admin.layout.template')

@section('title', 'Detail Laporan')

@section('content')
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Laporan</h4>
                <div class="form-group row">
                    <label for="employee_name" class="col-sm-3 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="employee_name" value="{{ $report->employee->name }}"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="department" class="col-sm-3 col-form-label">Bagian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="department"
                            value="{{ $report->employee->department->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Tanggal Laporan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="date"
                            value="{{ \Carbon\Carbon::parse($report->date)->format('d-m-Y') }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Judul Laporan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" value="{{ $report->title }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" rows="5" readonly>{{ $report->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="evidence" class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                        @if ($report->evidence)
                            <a href="{{ asset('storage/' . $report->evidence) }}" class="btn btn-secondary">Lihat
                                Lampiran</a>
                        @else
                            <label class="badge badge-danger">Tidak ada bukti yang dilampirkan</label>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 offset-sm-3">
                        <a href="{{ route('dashboard-laporan.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <form action="{{ route('dashboard-laporan.destroy', ['dashboard_laporan' => $report->id]) }}"
                        method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
