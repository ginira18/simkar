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
                                <input type="text" class="form-control" placeholder="12345678910" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Nama Lengkap" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single mb-0" style="width:100%">
                                    <option value="">Laki-laki</option>
                                    <option value="">Perempuan</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label required">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single" style="width:100%">
                                    <option value="">Islam</option>
                                    <option value="">Katolik</option>
                                    <option value="">Kristen</option>
                                    <option value="">Hindu</option>
                                    <option value="">Budha</option>
                                    <option value="">Lainnya</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label required">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Email" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="08XXXXXXXXXX" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Pendidikan Terakhir" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="exampleTextarea1" rows="4" required></textarea>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
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
                                <select class="js-example-basic-single" style="width:100%">
                                    <option value="">Islam</option>
                                    <option value="">Katolik</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label required">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Jabatan" required />
                            </div>
                            <label class="col-sm-6 col-form-label required">Jensi Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select class="js-example-basic-single" style="width:100%">
                                    <option value="">Bulanan</option>
                                    <option value="">Harian</option>
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

                            <div class="col-sm-9">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-9 col-form-label">Jaminan Kesehatan</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios1" value=""> Bpjs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                    id="membershipRadios2" value="option2"> Non-Bpjs </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Tempelkan kartu pegawai" />
                                {{-- <div class="col-9 pl-0 col-form-label">
                                <button type="button" class="btn btn-outline-danger btn-icon-text" data-toggle="modal"
                                    data-target="#modal_tambah_RFID">
                                    <i class="icon-cloud-upload btn-icon-prepend"></i> Daftarkan RFID </button>
                            </div> --}}
                                <div class="mt-5">
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
