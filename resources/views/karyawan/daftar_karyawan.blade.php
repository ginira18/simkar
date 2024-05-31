@extends('layout.template')

@section('title', 'Karyawan')
@section('content')
    <div class="m-1">
        <div class="card rounded justify-content">
            <div class="page-header">
                <h4 class="card-title mt-5 ml-4">Daftar Karyawan</h4>
                <a class="btn btn-primary mt-5 mr-4" href='{{ route('karyawan.create') }}'>Tambah
                    Karyawan</a>
            </div>
            <div class="py-3 col-3 flex">
                <input type="search" class="form-control" name="search" placeholder="Cari sesuatu ...">
            </div>
            <table class="table table-border table-hover">
                <thead>
                    <tr class="text-center">
                        <th class="py-4  font-weight-bold">No</th>
                        <th class="py-4 font-weight-bold">Nama</th>
                        <th class="py-4 font-weight-bold">NIP</th>
                        <th class="py-4 font-weight-bold">Bagian</th>
                        <th class="py-4 font-weight-bold">Jabatan</th>
                        <th class="py-4 font-weight-bold">Status RFID</th>
                        <th class="py-4 font-weight-bold">Aksi</th>


                    </tr>
                </thead>
                <tbody class="text-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Gilang Nico Raharjo </td>
                            <td>1234565432</td>
                            <td>Marketing</td>
                            <td>Kepala</td>
                            <td><label class="badge badge-danger">Belum terdaftar</label></td>
                            <td>
                                <a type="button" class="btn btn-primary btn-icon-text" href="{{ route('karyawan.show', $i) }}">
                            <i class="icon-info btn-icon-prepend"></i> Detail </a>
                            </td>
                        </tr>
                    @endfor

                </tbody>
            </table>
        </div>
    </div>
@endsection
