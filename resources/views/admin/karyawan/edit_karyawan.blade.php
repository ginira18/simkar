@extends ('admin.layout.template')

@section('title', 'Edit Karyawan')
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
                <h4 class="card-title mb-5">Edit Data Karyawan</h4>

                <form id="employeeForm" action="{{ route('karyawan.update', $employee->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                    name="nip" value="{{ old('nip', $employee->NIP) }}" />
                                @error('nip')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $employee->name) }}" />
                                @error('name')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                    id="birth_date" name="birth_date"
                                    value="{{ old('birth_date', $employee->birth_date) }}" />
                                @error('birth_date')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select
                                    class="js-example-basic-single mb-0 form-control @error('gender') is-invalid @enderror"
                                    style="width:100%" id="gender" name="gender">
                                    <option value="male"
                                        {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single form-control @error('religion') is-invalid @enderror"
                                    style="width:100%" id="religion" name="religion">
                                    <option value="Islam"
                                        {{ old('religion', $employee->religion) == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Katolik"
                                        {{ old('religion', $employee->religion) == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Kristen"
                                        {{ old('religion', $employee->religion) == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Hindu"
                                        {{ old('religion', $employee->religion) == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Budha"
                                        {{ old('religion', $employee->religion) == 'Budha' ? 'selected' : '' }}>Budha
                                    </option>
                                    <option value="Lainnya"
                                        {{ old('religion', $employee->religion) == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                @error('religion')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $employee->email) }}" />
                                @error('email')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $employee->phone_number) }}" />
                                @error('phone_number')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('last_education') is-invalid @enderror"
                                    id="last_education" name="last_education"
                                    value="{{ old('last_education', $employee->last_education) }}" />
                                @error('last_education')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="4">{{ old('address', $employee->address) }}</textarea>
                                @error('address')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="col-sm-9 mt-4">
                                <a href="{{ route('karyawan.show', $employee->id) }}" class="btn btn-dark">Kembali</a>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                                    id="hire_date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" />
                                @error('hire_date')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('hire_date_end') is-invalid @enderror"
                                    id="hire_date_end" name="hire_date_end"
                                    value="{{ old('hire_date_end', $employee->hire_date_end) }}" />
                                @error('hire_date_end')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Bagian</label>
                            <div class="col-sm-9">
                                <select
                                    class="js-example-basic-single form-control @error('department_id') is-invalid @enderror"
                                    style="width:100%" id="department_id" name="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    id="position" name="position" value="{{ old('position', $employee->position) }}" />
                                @error('position')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Jenis Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select
                                    class="js-example-basic-single form-control @error('employee_type') is-invalid @enderror"
                                    style="width:100%" id="employee_type" name="employee_type">
                                    <option value="monthly"
                                        {{ old('employee_type', $employee->employee_type) == 'monthly' ? 'selected' : '' }}>
                                        Bulanan</option>
                                    <option value="daily"
                                        {{ old('employee_type', $employee->employee_type) == 'daily' ? 'selected' : '' }}>
                                        Harian</option>
                                </select>
                                @error('employee_type')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>

                            <label class="col-sm-6 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('base_salary') is-invalid @enderror"
                                            id="base_salary" name="base_salary"
                                            value="{{ old('base_salary', number_format($employee->salary->base_salary, 0, ',', '.')) }}" />
                                    </div>
                                    @error('base_salary')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text"
                                            class="form-control @error('fix_allowance') is-invalid @enderror"
                                            id="fix_allowance" name="fix_allowance"
                                            value="{{ old('fix_allowance', number_format($employee->salary->fix_allowance, 0, ',', '.')) }}" />
                                    </div>
                                    @error('fix_allowance')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="form-group row mb-0">
                                    <label class="col-sm-9 col-form-label">Jaminan Kesehatan</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"
                                                    class="form-check-input @error('bpjs') is-invalid @enderror"
                                                    id="bpjs" name="bpjs" value="bpjs"
                                                    {{ old('bpjs', $employee->bpjs) == 'bpjs' ? 'checked' : '' }}> Bpjs
                                            </label>
                                        </div>
                                        @error('bpjs')
                                            <label class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"
                                                    class="form-check-input @error('bpjs') is-invalid @enderror"
                                                    id="bpjs" name="bpjs" value="no_bpjs"
                                                    {{ old('bpjs', $employee->bpjs) == 'no_bpjs' ? 'checked' : '' }}>
                                                Non-Bpjs
                                            </label>
                                        </div>
                                        @error('bpjs')
                                            <label class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('rfid_number') is-invalid @enderror"
                                    id="rfid_number" name="rfid_number"
                                    value="{{ old('rfid_number', $employee->rfid_number) }}" />
                                @error('rfid_number')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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


        document.getElementById('employeeForm').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });
    </script>
@endsection
