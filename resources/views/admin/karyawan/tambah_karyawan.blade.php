@extends ('admin.layout.template')

@section('title', 'Tambah Karyawan')
@section('content')

    {{-- <style>
        label::after {
            content: "*";
            color: red;
        }
    </style> --}}

    <div class="col-12 grid-margin">
        <div class="card m-1 rounded">
            <div class="card-body">
                <h4 class="card-title mb-5">Tambah Data Karyawan </h4>

                <form id="employeeForm" action="{{ route('karyawan.store') }}" method="POST">
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
                                    placeholder="12345678910" value="{{ old('nip') }}" />
                                {{-- @if ($errors->has('nip'))
                                    <label class="text-danger">
                                        {{ $errors->first('nip') }}
                                    </label>
                                @endif --}}
                                @error('nip')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Lengkap" value="{{ old('name') }}" />
                                @error('name')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    value="{{ old('birth_date') }}" />
                                @error('birth_date')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>


                            <label class="col-sm-6 col-form-label ">jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class=" js-example-basic-single mb-0" style="width:100%" id="gender"
                                    name="gender">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label ">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single" style="width:100%" id="religion" name="religion">
                                    <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Budha" {{ old('religion') == 'Budha' ? 'selected' : '' }}>Budha
                                    </option>
                                    <option value="Lainnya" {{ old('religion') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label ">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="08XXXXXXXXXX" value="{{ old('phone_number') }}" />
                                @error('phone_number')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="last_education" name="last_education"
                                    placeholder="Pendidikan Terakhir" value="{{ old('last_education') }}" />
                                @error('last_education')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" name="address" rows="4">{{ old('address') }}</textarea>
                                @error('address')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label ">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="hire_date" name="hire_date"
                                    placeholder="dd/mm/yyyy" value="{{ old('hire_date') }}" />
                                @error('hire_date')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="hire_date_end" name="hire_date_end"
                                    placeholder="dd/mm/yyyy" value="{{ old('hire_date_end') }}" />
                                @error('hire_date_end')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Bagian</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="department"
                                    name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label ">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Jabatan" value="{{ old('position') }}" />
                                @error('position')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label ">Jenis Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="employee_type"
                                    name="employee_type">
                                    <option value="monthly" {{ old('employee_type') == 'monthly' ? 'selected' : '' }}>
                                        Bulanan</option>
                                    <option value="daily" {{ old('employee_type') == 'daily' ? 'selected' : '' }}>Harian
                                    </option>
                                </select>
                                @error('employee_type')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label" id="base_salary_label">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" id="base_salary" name="base_salary"
                                            value="{{ old('base_salary', '0') }}" />
                                    </div>
                                    @error('base_salary')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
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
                                            name="fix_allowance" value="{{ old('fix_allowance', '0') }}" />
                                    </div>
                                    @error('fix_allowance')
                                        <label class="text-danger">
                                            {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label">Asuransi Ketenagakerjaan</label>
                            <div class="col-sm-9">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="bpjs"
                                                    {{ old('bpjs') == 'bpjs' ? 'checked' : '' }}>
                                                BPJS
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="no_bpjs"
                                                    name="bpjs" value="no_bpjs"
                                                    {{ old('bpjs') == 'no_bpjs' || old('bpjs') == '' ? 'checked' : '' }}>
                                                Non-BPJS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="rfid_number" name="rfid_number"
                                    placeholder="Tempelkan kartu pegawai" value="{{ old('rfid_number') }}" />
                                @error('rfid_number')
                                    <label class="text-danger">
                                        {{ $message }}
                                    </label>
                                @enderror
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

        baseSalariesInput.addEventListener('input', function() {
            formatNominal(this);
        });

        fixAllowanceInput.addEventListener('input', function() {
            formatNominal(this);
        });

        document.getElementById('employeeForm').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });
    </script>
@endsection
