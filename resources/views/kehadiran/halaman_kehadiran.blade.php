@extends('layout.template')

@section('title', 'Kehadiran')
@section('content')


    <div class="card rounded mb-5 col-md-12">
        <div class="row">
            <label class="col-md-3 form-group p-4" style="text-align: end"><h5>Pilih Tanggal</h5></label>
            <div class="col-md-4 form-group p-4">
                <input type="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary col-2 mb-5 mt-4" data-toggle="modal"
            data-target="#RFID">Cetak Kehadiran</button>
        </div>
    </div>

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card-body">
            <h4 class="card-title">Daftar Kehadiran</h4>
            <form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Nama </th>
                            <th> NIP </th>
                            <th> Bagian </th>
                            <th> Status</th>
                            <th> Jam Kehadiran </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Gilang Nico Raharjo </td>
                                <td>1234565432</td>
                                <td>Marketing</td>
                                <td><label class="badge badge-danger">Terlambat</label></td>
                                <td>00.00</td>
                            </tr>
                        @endfor

                    </tbody>
                </table>
            </form>
        </div>
    </div>

    {{-- modal RFID --}}
    <div class="modal fade" id="RFID" tabindex="-1" role="dialog" aria-labelledby="RFID"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="text-align: center">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah RFID</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-2">
                            <label>
                                <h5>Tempelkan Kartu Pada Pembaca RFID</h5>
                            </label>
                            <input type="text" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
