@extends ('layout.template')

@section('title', 'Detail Karyawan')
@section('content')

    <div class="col-12 grid-margin">
        <div class="card m-1 rounded">
            <div class="card-body">
                <h4 class="card-title mb-5">Detail Karyawan</h4>

                <form class="detail" action="/daftar_karyawan" method="POST">
                    @csrf
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="NIP" name="NIP"
                                    placeholder="12345678910" />
                            </div>

                            <label class="col-sm-6 col-form-label ">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Lengkap" value="{{$employee->name}}" />
                            </div>

                            <label class="col-sm-6 col-form-label ">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="birth_date" name="birth_date" />
                            </div>

                            <label class="col-sm-6 col-form-label ">jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class=" js-example-basic-single mb-0" style="width:100%" id="gender"
                                    name="gender" disabled>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label ">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single" style="width:100%" id="religion" name="religion"
                                    disabled>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buhda">Budha</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Email</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="email" name="email"
                                    placeholder="Email" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="08XXXXXXXXXX" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="last_education"
                                    name="last_education" placeholder="Pendidikan Terakhir" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" name="address" rows="4" readonly></textarea>
                            </div>

                            <div class=" col-sm-9 mt-4">
                                <a href="/daftar_karyawan" class="btn btn-dark">Kembali</a>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label ">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="hire_date" name="hire_date"
                                    placeholder="dd/mm/yyyy" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="hire_date_end" name="hire_date_end"
                                    placeholder="dd/mm/yyyy" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Bagian</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="" name=""
                                    disabled>
                                    <option value="">Marketing</option>
                                    <option value="">Packing</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Jabatan</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="position" name="position"
                                    placeholder="Jabatan" />
                            </div>
                            <label class="col-sm-6 col-form-label ">Jenis Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="employee_type"
                                    name="employee_type" disabled>
                                    <option value="monthly">Bulanan</option>
                                    <option value="daily">Harian</option>
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" id="base_salaries"
                                            name="base_salaries" readonly>
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
                                        <input type="text" class="form-control" id="fix_allowance"
                                            name="fix_allowance" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-9 col-form-label">Jaminan Kesehatan</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="bpjs" checked disabled> Bpjs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="non_bpjs" disabled> Non-Bpjs </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="rfid_number" name="rfid_number"
                                    placeholder="Tempelkan kartu pegawai" readonly />
                                {{-- <div class="col-9 pl-0 col-form-label">
                            <button type="button" class="btn btn-outline-danger btn-icon-text" data-toggle="modal"
                                data-target="#modal_tambah_RFID">
                                <i class="icon-cloud-upload btn-icon-prepend"></i> Daftarkan RFID </button>
                             </div> --}}
                            </div>
                            
                            <div class=" col-sm-9 mt-5">
                                <a href="/edit_karyawan" class="btn btn-warning">Edit</a>
                                <button type="" class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal RFID --}}
    {{-- <div class="modal fade" id="modal_tambah_RFID" tabindex="-1" role="dialog" aria-labelledby="modal_tambah_RFID"
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
    </div> --}}
@endsection
