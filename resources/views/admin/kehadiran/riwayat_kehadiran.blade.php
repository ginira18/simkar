@extends('admin.layout.template')

@section('title', 'Riwayat kehadiran')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Kehadiran</h4>
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
                                <th> Status </th>
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
                                    <td><label class="badge badge-success">Hadir</label></td>
                                    <td>00.00</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
