@extends('layout.template')

@section('title', 'Izin')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Izin Karyawan</h4>
                <form>
                    <table class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIP </th>
                                <th> Bagian </th>
                                <th> Status Izin </th>
                                <th class="pl-5"> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Gilang Nico Raharjo </td>
                                    <td>1234565432</td>
                                    <td>Marketing</td>
                                    <td><label class="badge badge-success">Diterima</label></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#izin">Detail</button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    {{-- modal detail izin --}}
    <div class="modal fade" id="izin" tabindex="-1" role="dialog" aria-labelledby="izin" aria-hidden="true">
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
    </div>

@endsection
