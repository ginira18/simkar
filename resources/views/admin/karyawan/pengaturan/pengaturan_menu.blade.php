@extends ('admin.layout.template')

@section('title', 'Pengaturan Karyawan')
@section('content')

    <style>
        .card-body {
            max-height: 600px;
            min-height: 600px;
            overflow-y: auto;
        }

        .fix-header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 100;
        }
    </style>
    <div class="container">
        @if(session('status_error'))
            <div class="alert alert-danger">
                {{ session('status_error') }}
            </div>
        @endif

        @if(session('status_success'))
            <div class="alert alert-success">
                {{ session('status_success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Bagian Aktif</h4>
                        <div class="row justify-content-end">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary btn-md mt-2" data-toggle="modal"
                                    data-target="#modal_tambah_bagian">Tambah Bagian</button>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-4  font-weight-bold">No</th>
                                    <th class="py-4 font-weight-bold">Nama Bagian</th>
                                    <th class="py-4 font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($activeDepartments as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <form action="{{ route('pengaturan-karyawan.deactivate', $department->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-dark btn-sm">Non-Aktif</button>
                                            </form>
                                            {{-- <form class="d-inline" action="{{ route('pengaturan-karyawan.destroy', $department->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Bagian Non-Aktif</h4>
                        <div class="row justify-content-end">
                            <div class="col-sm-6 mt-5">
                                {{-- <button type="button" class="btn btn-primary mt-2"
                                    onclick="window.location.href='/tambah_karyawan'">Tambah
                                    Karyawan</button> --}}
                            </div>
                        </div>
                        <table class="table table-hover mt-1">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-4  font-weight-bold">No</th>
                                    <th class="py-4 font-weight-bold">Nama Bagian</th>
                                    <th class="py-4 font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($inactiveDepartments as $department)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <form action="{{ route('pengaturan-karyawan.activate', $department->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-dark btn-sm">Aktif</button>
                                            </form>
                                            <form class="d-inline" action="{{ route('pengaturan-karyawan.destroy', $department->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Bagian --}}
    <div class="modal fade" id="modal_tambah_bagian" tabindex="-1" role="dialog" aria-labelledby="modal_tambah_bagian"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Tambah Bagian</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('pengaturan-karyawan.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>
                                <h5>Nama Bagian</h5>
                            </label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div>
                            <button type="subnit" class="btn btn-primary mt-2">Tambah Bagian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 rounded mb-5">
        <h4 class="card-title mt-4 ml-3">Daftar Karyawan Non-Aktif</h4>
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
                @foreach ($inactiveEmployees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->NIP }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>
                            <a type="button" class="btn btn-primary btn-icon-text"
                                href="{{ route('pengaturan-karyawan.show', $employee->id) }}">
                                <i class="icon-info btn-icon-prepend"></i> Detail </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection



{{-- <div class="d-md-flex row m-2 quick-action-btns">
    <div class=" card col-md-5 m-5 p-3 text-center rounded bg-primary">
        <a href="/daftar_bagian_karyawan" type="button" class="btn p-0"><i class="icon-envelope-letter mr-2"></i> Daftar
            Bagian</a>
    </div>
</div> --}}
