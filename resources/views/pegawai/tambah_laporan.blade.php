@extends('pegawai.template')

@section('title', 'Tambah Laporan')
@section('content')
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Laporan</h4>
            <form action="{{ route('karyawan.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-2 pt-3">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                    <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Judul Laporan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
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
                        <input type="file" class="form-control-file @error('evidence') is-invalid @enderror" id="evidence" name="evidence">
                        @error('evidence')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
