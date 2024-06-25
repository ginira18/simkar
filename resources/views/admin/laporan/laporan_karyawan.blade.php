@extends('admin.layout.template')

@section('title', 'Laporan Karyawan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Laporan Karyawan</h4>

                <form>
                    <div class="row">
                        <div class="col-md-3 mt-5">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3 mt-5 ml-auto">
                            <input type="search" class="form-control" name="search" placeholder="Cari sesuatu ...">
                        </div>
                    </div>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIP </th>
                                <th> Bagian </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Gilang Nico Raharjo </td>
                                    <td>1234565432</td>
                                    <td>Marketing</td>
                                    <td><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#laporan_karyawan">Detail</button></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    {{-- modal laporan karyawan --}}
    <div class="modal fade" id="laporan_karyawan" tabindex="-1" role="dialog" aria-labelledby="laporan_karyawan"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div>
                    <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="col-sm-12">
                            <label class="col-sm-6 col-form-label">Laporan Harian</label>
                            <div class="form-group m-0">
                                <textarea class="form-control" id="exampleTextarea1" rows="4" readonly>1. Karyawan hadir,melakukan pekerjaan sesuai dengan tugasnya.
                                </textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
