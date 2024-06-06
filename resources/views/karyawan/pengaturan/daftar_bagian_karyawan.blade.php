@extends ('layout.template')

@section('title', 'Pengaturan Karyawan')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Bagian Aktif</h4>
                        <div class="row justify-content-end">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#modal_tambah_bagian">Tambah Bagian</button>
                            </div>
                        </div>
                        <table class="table table-border table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-4  font-weight-bold">No</th>
                                    <th class="py-4 font-weight-bold">Nama Bagian</th>
                                    <th class="py-4 font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <label">Marketing</label>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle"
                                                    data-toggle="dropdown">Aksi</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item">Non-Aktif</a>
                                                    <a class="dropdown-item">Hapus</a>
                                                </div>
                                        </td>
                                    </tr>
                                @endfor
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
                        <table class="table table-border table-hover mt-1">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-4  font-weight-bold">No</th>
                                    <th class="py-4 font-weight-bold">Nama Bagian</th>
                                    <th class="py-4 font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <label">Marketing</label>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark dropdown-toggle"
                                                    data-toggle="dropdown">Aksi</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item">Aktif</a>
                                                    <a class="dropdown-item">Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
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
                    <form>
                        <div class="mb-2">
                            <label>
                                <h5>Nama Bagian</h5>
                            </label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <button type="subnit" class="btn btn-primary mt-2">Tambah Bagian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 grid-margin">
        <h4 class="card-title mb-5">Pengaturan</h4>
        <div class="card m-1 rounded">
            <form class="form-tambah-karyawan">
                <div class="row">
                    kiri
                    <div class="col-md-6">
                        <h4 class="card-title p-2">Daftar Bagian Aktif</h4>
                        <div class="row justify-content-end">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary mt-2"
                                    onclick="window.location.href='/tambah_karyawan'">Tambah
                                    Karyawan</button>
                            </div>
                        </div>
                        <table class="table table-border table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="py-4  font-weight-bold">No</th>
                                    <th class="py-4 font-weight-bold">Nama Bagian</th>
                                    <th class="py-4 font-weight-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <label">Marketing</label>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                    data-toggle="dropdown">Aksi</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item">Non Aktif</a>
                                                    <a class="dropdown-item">Hapus</a>
                                                </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>


                    kanan
                    <div class="col-md-6">
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection
