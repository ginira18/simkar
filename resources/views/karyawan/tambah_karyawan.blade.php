@extends ('layout.template')

@section('title', 'Tambah Karyawan')
@section('content')

    <style>
        .required:after {
            content: "*";
            color: red;
        }
    </style>

    <div class="col-12 grid-margin">
        <div class="card m-1 rounded">
            <div class="card-body">
                <h4 class="card-title mb-5">Tambah Data Karyawan</h4>

                <form class="form-tambah-karyawan">
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label required">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-3 col-form-label required">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-control" required>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <label class="col-sm-3 col-form-label ">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control">
                                    <option>kategori</option>
                                    <option>kategori</option>
                                    <option>kategori</option>
                                    <option>kategori</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label required">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="exampleTextarea1" rows="4" required></textarea>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label required">pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" required placeholder="dd/mm/yyyy" />
                            </div>
                            <label class="col-sm-6 col-form-label required">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" required placeholder="dd/mm/yyyy" />
                            </div>
                            <label class="col-sm-6 col-form-label required">Bagian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Jenis Karyawan</label>
                            <div class="col-sm-9">
                                <select class="form-control" required>
                                    <option>Bulanan</option>
                                    <option>Harian</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label required">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label required">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Membership</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios1" value=""> Free
                                            </label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios1" value="" checked=""> Free <i
                                                    class="input-helper"></i></label>
                                        </div> --}}
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios2" value="option2"> Professional </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" />
                                {{-- <div class="col-9 pl-0 col-form-label">
                                <button type="button" class="btn btn-outline-danger btn-icon-text" data-toggle="modal"
                                    data-target="#modal_tambah_RFID">
                                    <i class="icon-cloud-upload btn-icon-prepend"></i> Daftarkan RFID </button>
                            </div> --}}
                                <div class="text- mt-4 col-9">
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
