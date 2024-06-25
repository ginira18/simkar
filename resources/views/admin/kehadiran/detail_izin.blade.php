@extends('admin.layout.template')

@section('title', 'Permintaan Izin')
@section('content')
    @if (session('status') == 'success')
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session('status') == 'error')
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <form action="{{ route('approve-izin', $permission->id) }}" method="POST">
                @csrf
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
                            <a href="{{ asset('storage/evidence_izin/' . $permission->evidence) }}" class="btn btn-secondary">Lihat Bukti</a>
                        @else
                            <label class="badge badge-danger">Tidak ada bukti yang dilampirkan</label >
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

                <div class="btn-group col-md-4 mt-3 p-0" role="group" aria-label="Basic example">
                    <button  @if($permission->status != "Pending") disabled @endif type="submit" class="btn btn-danger" name="button_approve" value="Rejected">Tolak</button>
                    <button  @if($permission->status != "Pending") disabled @endif type="submit" class="btn btn-success" name="button_approve" value="Approved">Terima</button>
                </div>
            </form>
        </div>
    </div>
@endsection
