@extends('layout.template')

@section('title', 'Laporan Gaji')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Laporan Penggajian</h4>
                <form class="mt-5">
                    <div>
                        <label class="col-sm-6 col-form-label p-0">
                            <h5>Per-Bulan</h5>
                        </label>
                        <input type="date" class="form-control p-0 col-md-2" />
                    </div>
                    <table class="table table-striped mt-2">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIP </th>
                                <th> Bagian </th>
                                <th> Status Gaji </th>
                                <th class="pl-5"> Total Gaji </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Gilang Nico Raharjo </td>
                                    <td>1234565432</td>
                                    <td>Marketing</td>
                                    <td><label class="badge badge-success">Diberikan</label></td>
                                    <td>Rp. 1000000</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total Gaji :</h4>
                <input type="text" class="form-control" value="Rp. 5000000" disabled>
            </div>
        </div>
    </div>
@endsection
