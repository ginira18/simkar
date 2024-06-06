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
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
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
                        <th class="py-4 font-weight-bold">Aksi</th>


                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($activeEmployees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->NIP }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>
                                <a type="button" class="btn btn-primary btn-icon-text"
                                    href="{{route('karyawan.show', $employee->id) }}">
                                    <i class="icon-info btn-icon-prepend"></i> Detail </a>
                            </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection


{{-- <a type="button" class="btn btn-primary btn-icon-text"
                                    href="/karyawan/{{$employee->id }}">
                                    <i class="icon-info btn-icon-prepend"></i> Detail </a> --}}