@extends ('layout.template')

@section('title', 'Tambah Karyawan')
@section('content')

    <style>
        .:after {
            content: "*";
            color: red;
        }
    </style>

    <div class="col-12 grid-margin">
        <div class="card m-1 rounded">
            <div class="card-body">
                <h4 class="card-title mb-5">Tambah Data Karyawan</h4>

                <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="NIP" name="nip"
                                    placeholder="12345678910" />
                                @if ($errors->has('nip'))
                                    <label class="text-danger">
                                        {{ $errors->first('nip') }}
                                    </label>
                                @endif
                            </div>

                            <label class="col-sm-6 col-form-label ">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Lengkap" />
                                @if ($errors->has('name'))
                                    <label class="text-danger">
                                        {{ $errors->first('name') }}
                                    </label>
                                @endif
                            </div>

                            <label class="col-sm-6 col-form-label ">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birth_date" name="birth_date" />
                                @if ($errors->has('birth_date'))
                                    <label class="text-danger">
                                        {{ $errors->first('birth_date') }}
                                    </label>
                                @endif
                            </div>

                            <label class="col-sm-6 col-form-label ">jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class=" js-example-basic-single mb-0" style="width:100%" id="gender"
                                    name="gender">
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label ">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single" style="width:100%" id="religion" name="religion">
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
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Email" />
                                @if ($errors->has('email'))
                                    <label class="text-danger">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="08XXXXXXXXXX" />
                                @if ($errors->has('phone_number'))
                                    <label class="text-danger">
                                        {{ $errors->first('phone_number') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_education" name="last_education"
                                    placeholder="Pendidikan Terakhir" />
                                @if ($errors->has('last_education'))
                                    <label class="text-danger">
                                        {{ $errors->first('last_education') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                                @if ($errors->has('address'))
                                    <label class="text-danger">
                                        {{ $errors->first('address') }}
                                    </label>
                                @endif
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label ">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="hire_date" name="hire_date"
                                    placeholder="dd/mm/yyyy" />
                                @if ($errors->has('hire_date'))
                                    <label class="text-danger">
                                        {{ $errors->first('hire_date') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="hire_date_end" name="hire_date_end"
                                    placeholder="dd/mm/yyyy" />
                                @if ($errors->has('hire_date_end'))
                                    <label class="text-danger">
                                        {{ $errors->first('hire_date_end') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Bagian</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="department"
                                    name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-6 col-form-label ">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Jabatan" />
                                @if ($errors->has('position'))
                                    <label class="text-danger">
                                        {{ $errors->first('position') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Jenis Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="employee_type"
                                    name="employee_type">
                                    <option value="monthly">Bulanan</option>
                                    <option value="daily">Harian</option>
                                </select>
                                @if ($errors->has('employee_type'))
                                    <label class="text-danger">
                                        {{ $errors->first('employee_type') }}
                                    </label>
                                @endif
                            </div>
                            <label class="col-sm-6 col-form-label ">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" id="base_salary" name="base_salary">
                                    </div>
                                    @if ($errors->has('base_salary'))
                                        <label class="text-danger">
                                            {{ $errors->first('base_salary') }}
                                        </label>
                                    @endif
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
                                            name="fix_allowance">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-9 col-form-label">Asuransi Ketenagakerjaan</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="bpjs" checked> Bpjs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="no_bpjs"> Non-Bpjs </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="rfid_number" name="rfid_number"
                                    placeholder="Tempelkan kartu pegawai" />
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary ">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Fungsi untuk menambahkan titik pada nominal
        function formatNominal(input) {
            // Hapus semua karakter selain angka
            var value = input.value.replace(/\D/g, '');
            // Tambahkan titik setiap tiga digit dari belakang
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            // Update nilai input
            input.value = value;
        }

        // Ambil input gaji pokok
        var baseSalariesInput = document.getElementById('base_salary');
        var fixAllowanceInput = document.getElementById('fix_allowance');

        // Tambahkan event listener untuk memanggil fungsi formatNominal saat nilai input berubah
        baseSalariesInput.addEventListener('input', function() {
            formatNominal(this);
        });

        fixAllowanceInput.addEventListener('input', function() {
            formatNominal(this);
        });
    </script>
@endsection
