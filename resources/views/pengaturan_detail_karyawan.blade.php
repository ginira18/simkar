@extends ('layout.template')

@section('title', 'Detail Karyawan')
@section('content')

    <style>
        .required:after {
            content: "*";
            color: red;
        }
    </style>

    <div class="card m-1 rounded">
        <div class="col-12 grid-margin">
            <div class="card-body">
                <h4 class="card-title mb-5">Tambah Data Karyawan</h4>

                <form class="form-tambah-karyawan">
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label ">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-3 col-form-label ">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-control" readonly>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <label class="col-sm-3 col-form-label ">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control" readonly>
                                    <option>kategori</option>
                                    <option>kategori</option>
                                    <option>kategori</option>
                                    <option>kategori</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="exampleTextarea1" rows="4" readonly></textarea>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label ">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input class="form-control" readonly placeholder="dd/mm/yyyy" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Bagian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly />
                            </div>
                            <label class="col-sm-6 col-form-label ">Jenis Karyawan</label>
                            <div class="col-sm-9">
                                <select class="form-control" readonly>
                                    <option>Bulanan</option>
                                    <option>Harian</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label ">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label ">Status RFID</label>
                            <div class="col-sm-9">
                                <label class="badge badge-success">Terdaftar</label>
                                <div class="col-9 p-0 mt-2">
                                    <button type="button" class="btn btn-outline-danger btn-icon-text" data-toggle="modal"
                                        data-target="#modal_tambah_RFID">
                                        <i class="icon-cloud-upload btn-icon-prepend"></i> Perbarui RFID </button>
                                </div>
                                <div class="card-description mt-3 ">
                                    <code>
                                *Pilih bagian karyawan aktif untuk mengaktifkan kembali status karyawan
                                    </code>
                                </div>
                                <div class="text- mt-4 col-9 p-0">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal RFID --}}
    <div class="modal fade" id="modal_tambah_RFID" tabindex="-1" role="dialog" aria-labelledby="modal_tambah_RFID"
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
