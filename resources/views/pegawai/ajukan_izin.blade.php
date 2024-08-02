@extends('pegawai.template')

@section('title', 'Ajukan Izin')
@section('content')
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title mb-3">Ajukan Izin</h4>
            @if (session('status_error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" id="status_error">
                    {{ session('status_error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('izin-karyawan-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="start_date" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                            name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end_date" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                            name="end_date" value="{{ old('end_date') }}">
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reason" class="col-sm-3 col-form-label">Alasan Izin</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3"
                            required>{{ old('reason') }}</textarea>
                        @error('reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="evidence" class="col-sm-3 col-form-label">Bukti (Opsional)</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control-file @error('evidence') is-invalid @enderror"
                            id="evidence" name="evidence">
                        @error('evidence')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
