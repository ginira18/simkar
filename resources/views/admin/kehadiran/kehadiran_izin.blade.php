@extends('admin.layout.template')

@section('title', 'Izin')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Izin Karyawan</h4>
                <form>
                    <div class="form-group col-md-12 pl-0 mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $permission->employee->name}}</td>
                                        <td>{{ $permission->start_date }}</td>
                                        <td>{{ $permission->end_date }}</td>
                                        <td>
                                            @if ($permission->status == 'Pending')
                                                <label class="badge badge-warning">{{$permission->status }}</label>
                                            @elseif($permission->status == 'Approved')
                                                <label class="badge badge-success">{{$permission->status }}</label>
                                            @elseif($permission->status == 'Rejected')
                                                <label class="badge badge-danger">{{$permission->status }}</label>
                                            @else
                                                <label class="badge badge-secondary">{{$permission->status }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-primary btn-sm btn-icon-text"
                                                href="{{ route('detail-izin-admin', $permission->id) }}">
                                                <i class="icon-info btn-icon-prepend"></i> Detail 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    {{-- modal detail izin --}}
    {{-- <div class="modal fade" id="izin" tabindex="-1" role="dialog" aria-labelledby="izin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div>
                    <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-2">
                            <label>
                                <h5>Keterangan</h5>
                            </label>
                            <textarea class="form-control" id="exampleTextarea1" rows="4" required></textarea>
                        </div>
                        <div class="col-9 p-0 mt-2">
                            <button type="button" class="btn btn-outline-warning btn-icon-text">
                                <i class="icon-docs btn-icon-prepend"></i> Bukti </button>
                        </div>
                        <div class="btn-group col-12 mt-3 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger">Tolak</button>
                            <button type="button" class="btn btn-success">Terima</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> --}}

