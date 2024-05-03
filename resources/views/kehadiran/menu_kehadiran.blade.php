@extends('layout.template')

@section('title', 'Kehadiran')
@section('content')

    <div class="d-md-flex row m-2 quick-action-btns" role="group">
        <div class=" card col-md-3 m-5 p-3 text-center btn-wrapper rounded bg-success">
            {{-- <button type="button" class="btn p-0" style="font-size: 700;"> <i class="icon-user mr-2"></i> Kehadiran </button> --}}
            <button type="button" class="btn p-0" onclick="window.location.href='/halaman_kehadiran'">
                <i class="icon-check mr-2"></i>
                Kehadiran </button>
        </div>
        <div class=" card col-md-3 m-5 p-3 text-center btn-wrapper rounded bg-warning">
            <button type="button" class="btn p-0" onclick="window.location.href='/kehadiran_izin'"><i
                    class="icon-envelope-letter
                mr-2"></i> Permintaan
                Izin</button>
        </div>
        <div class=" card col-md-3 m-5 p-3 text-center btn-wrapper rounded bg-primary">
            <button type="button" class="btn p-0" onclick="window.location.href='/riwayat_kehadiran'"><i
                    class="icon-notebook mr-2"></i> Riwayat Kehadiran</button>
        </div>
    </div>

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Hadir Hari Ini</h4>
                <form>
                    <table class="table table-striped mt-5">
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
                                    <td><label class="badge badge-warning">Izin</label></td>
                                    <td>00.00</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="container row ">
        <div class="card col-3 m-2">
            jbkbj
        </div>
        <div class="card col-3 m-2">
            jbkbj
        </div>
        <div class="card col-3 m-2">
            jbkbj
        </div>
    </div> --}}
@endsection
