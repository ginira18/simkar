@extends('pegawai.template')

@section('title', 'Detail Laporan')
@section('content')
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Laporan</h4>
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-md-4" id="date" name="date"
                        value="{{ \Carbon\Carbon::parse($report->date)->translatedFormat('l, d F Y') }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Judul Laporan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-md-8" id="title" name="title"
                        value="{{ $report->title }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="description" name="description" rows="5" readonly>{{ $report->description }}</textarea>
                </div>
            </div>
                <div class="form-group row">
                    <label for="evidence" class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                        @if ($report->evidence)
                            <a href="{{ asset('storage/' . $report->evidence) }}" class="btn btn-secondary">Lihat lampiran</a>
                        @else
                            <label class="badge badge-danger">Tidak ada lampiran yang dilampirkan</label >
                        @endif
                    </div>
                </div>

            <div class="form-group row">
                <div class="col-sm-9">
                    <a href="{{ route('laporan-karyawan') }}" class="btn btn-primary">Kembali</a>
                    <a href="{{ route('karyawan.laporan.edit', ['id' => $report->id]) }}" class="btn btn-warning ml-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
