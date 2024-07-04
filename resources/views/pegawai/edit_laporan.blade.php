@extends('pegawai.template')

@section('title', 'Edit Laporan')
@section('content')
<div class="col-sm-12 grid-margin card rounded">
    <div class="card-body">
        <h4 class="card-title mb-3">Edit Laporan</h4>
        <form action="{{ route('laporan-karyawan.update', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Judul Laporan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        value="{{ old('title', $report->title) }}" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-3 col-form-label">Deskripsi Laporan</label>
                <div class="col-sm-9">
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5" required>{{ old('description', $report->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="evidence" class="col-sm-3 col-form-label">Lampiran (Opsional)</label>
                <div class="col-sm-9">
                    @if ($report->evidence)
                    <div class="d-flex align-items-center">
                        <a href="{{ asset('storage/' . $report->evidence) }}" class="btn btn-secondary">Lihat Lampiran</a>
                        {{-- <span class="ml-3">{{ $report->evidence }}</span> --}}
                    </div>
                    @else
                    <label class="badge badge-danger">Tidak ada lampiran yang dilampirkan</label >
                    @endif
                    <input type="file" class="form-control-file mt-2 @error('evidence') is-invalid @enderror" id="evidence" name="evidence">
                    @error('evidence')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('laporan-karyawan') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
