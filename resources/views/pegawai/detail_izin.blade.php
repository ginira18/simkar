@extends('pegawai.template')

@section('title', 'Detail Izin')
@section('content')
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Izin</h4>

            @if (session('status_error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status_error') }}
                </div>
            @endif
            @if (session('status_success'))
                <div class="alert alert-success" role="alert">
                    {{ session('status_success') }}
                </div>
            @endif

            <div class="form-group row">
                <label for="start_date" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-md-4" id="start_date" name="start_date"
                        value="{{ $permission->start_date }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control col-md-4" id="end_date" name="end_date"
                        value="{{ $permission->end_date }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="reason" class="col-sm-3 col-form-label">Alasan Izin</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="reason" name="reason" rows="5" readonly>{{ $permission->reason }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="evidence" class="col-sm-3 col-form-label">Bukti</label>
                <div class="col-sm-9">
                    @if ($permission->evidence)
                        <a href="{{ asset('storage/evidence_izin/' . $permission->evidence) }}"
                            class="btn btn-secondary">Lihat Bukti</a>
                    @else
                        <label class="badge badge-danger">Tidak ada bukti yang dilampirkan</label>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    @if ($permission->status == 'Pending')
                        <label class="badge badge-warning">{{ $permission->status }}</label>
                    @elseif($permission->status == 'Approved')
                        <label class="badge badge-success">{{ $permission->status }}</label>
                    @elseif($permission->status == 'Rejected')
                        <label class="badge badge-danger">{{ $permission->status }}</label>
                    @else
                        <label class="badge badge-secondary">{{ $permission->status }}</label>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <a href="{{ route('izin-karyawan') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('izin-edit-create', ['id' => $permission->id]) }}"
                        class="btn btn-warning {{ $permission->status != 'Pending' ? 'disabled' : '' }}">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
