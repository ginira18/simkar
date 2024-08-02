@extends ('admin.layout.template')

@section('title', 'Detail Karyawan')
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
                <h4 class="card-title mb-5">Detail Karyawan</h4>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                        <h4>*Ubah bagian untuk mengaktifkan lagi karyawan</h4>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    @csrf
                    <div class="row">
                        {{-- kiri --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Nomor Induk Pegawai (NIP) </label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="NIP" name="NIP"
                                    value="{{ $employee->NIP }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="name" name="name"
                                    value="{{ $employee->name }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="birth_date" name="birth_date"
                                    value="{{ $employee->birth_date }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Jenis Kelamin</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single mb-0" style="width:100%" id="gender"
                                    name="gender" disabled>
                                    <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label">Agama</label>
                            <div class="form-group col-sm-9 mb-0">
                                <select class="js-example-basic-single" style="width:100%" id="religion" name="religion"
                                    disabled>
                                    <option value="Islam" {{ $employee->religion == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Katolik" {{ $employee->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Kristen" {{ $employee->religion == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Hindu" {{ $employee->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Budha" {{ $employee->religion == 'Budha' ? 'selected' : '' }}>Budha
                                    </option>
                                    <option value="Lainnya" {{ $employee->religion == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="email" name="email"
                                    value="{{ $employee->email }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $employee->phone_number }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Pendidikan Terakhir</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="last_education"
                                    name="last_education" value="{{ $employee->last_education }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="address" name="address" rows="4" readonly>{{ $employee->address }}</textarea>
                            </div>

                            <div class="col-sm-9 mt-4">
                                <a href="{{ route('pengaturan-karyawan.index') }}" class="btn btn-dark">Kembali</a>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="col-md-6">
                            <label class="col-sm-6 col-form-label">Tanggal Bergabung</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="hire_date" name="hire_date"
                                    value="{{ $employee->hire_date }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Masa Kontrak</label>
                            <div class="col-sm-9">
                                <input readonly type="date" class="form-control" id="hire_date_end" name="hire_date_end"
                                    value="{{ $employee->hire_date_end }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Bagian</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="department" name="department"
                                    disabled>
                                    <option value="{{ $employee->department->id }}" selected>
                                        {{ $employee->department->name }}</option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input readonly type="text" class="form-control" id="position" name="position"
                                    value="{{ $employee->position }}" />
                            </div>

                            <label class="col-sm-6 col-form-label">Jenis Karyawan</label>
                            <div class="form-group col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" id="employee_type"
                                    name="employee_type" disabled>
                                    <option value="monthly" {{ $employee->employee_type == 'monthly' ? 'selected' : '' }}>
                                        Bulanan</option>
                                    <option value="daily" {{ $employee->employee_type == 'daily' ? 'selected' : '' }}>
                                        Harian</option>
                                </select>
                            </div>

                            <label class="col-sm-6 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input readonly type="text" class="form-control" id="base_salaries"
                                            name="base_salaries"
                                            value="{{ number_format($employee->salary->base_salary, 0, ',', '.') }}" />
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 col-form-label">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input readonly type="text" class="form-control" id="fix_allowance"
                                            name="fix_allowance"
                                            value="{{ number_format($employee->salary->fix_allowance, 0, ',', '.') }}" />
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
                                                    name="bpjs" value="bpjs"
                                                    {{ $employee->bpjs == 'bpjs' ? 'checked' : '' }} disabled> Bpjs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="bpjs"
                                                    name="bpjs" value="non_bpjs"
                                                    {{ $employee->bpjs == 'no_bpjs' ? 'checked' : '' }} disabled> Non-Bpjs
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-6 form-label">RFID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="rfid_number" name="rfid_number"
                                    value="{{ $employee->rfid_number }}" readonly />
                            </div>

                            <div class="col-sm-9 mt-5">
                                <a href="{{ route('pengaturan-karyawan.edit', $employee->id) }}"
                                    class="btn btn-warning">Edit</a>

                                <form action="{{ route('karyawan.activate', $employee->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary m-1">Aktif</button>
                                </form>

                                <form action="{{ route('pengaturan-karyawan.employeeDestroy', $employee->id) }}" method="POST"
                                    style="display:inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
