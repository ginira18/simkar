@extends('admin.layout.template')

@section('title', 'Detail Gaji Karyawan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Detail Gaji Karyawan</h4>
                
                <!-- Display flash message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="row" method="POST" action="{{ route('gaji.give-salary', $employee->id) }}" onsubmit="prepareFormForSubmission()">
                @csrf
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="py-3"><strong>Nama</strong></p>
                                <p class="py-3"><strong>NIP</strong></p>
                                <p class="py-3"><strong>Bagian</strong></p>
                                <p class="py-3"><strong>Jabatan</strong></p>
                                <p class="py-3"><strong>Jenis Karyawan</strong></p>
                                <p class="py-3"><strong>Gaji Pokok</strong></p>
                                <p class="py-3"><strong>Tunjangan Tetap</strong></p>
                                <p class="py-3"><strong>Asuransi</strong></p>
                                <p class="py-3"><strong>Tanpa Keterangan</strong></p>
                                <p class="py-3"><strong>Izin</strong></p>
                                <p class="py-3"><strong>Terlambat</strong></p>
                            </div>
                            <div class="col-sm-6">
                                <p class="py-3">: {{ $employee->name }}</p>
                                <p class="py-3">: {{ $employee->NIP }}</p>
                                <p class="py-3">: {{ $employee->department->name }}</p>
                                <p class="py-3">: {{ $employee->position }}</p>
                                <p class="py-3">: {{ $employee->employee_type == 'monthly' ? 'Bulanan' : 'Harian' }}</p>
                                <p class="py-3">: Rp.<span
                                        id="base_salary">{{ number_format($employee->salary->base_salary, 0, ',', '.') }}</span>
                                </p>
                                <input type="hidden" name="base_salary" value="{{ $employee->salary->base_salary }}">
                                <p class="py-3">: Rp.<span
                                        id="fix_allowance">{{ number_format($employee->salary->fix_allowance, 0, ',', '.') }}</span>
                                </p>
                                <input type="hidden" name="fix_allowance" value="{{ $employee->salary->fix_allowance }}">
                                <p class="py-3">
                                    @if ($employee->bpjs == 'bpjs')
                                        : BPJS
                                    @else
                                        : Tidak ada
                                    @endif
                                </p>
                                <p class="py-3">: {{ $alpha }}</p>
                                <p class="py-3">: {{ $izin }}</p>
                                <p class="py-3">: {{ $terlambat }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-6 col-form-label">Potongan Asuransi</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="insurance_cut" name="cut_insurance"
                                        value="{{ number_format($potonganAsuransi, 0, ',', '.') }}" readonly>
                                </div>
                                @if ($errors->has('cut_insurance'))
                                    <label class="text-danger">
                                        {{ $errors->first('cut_insurance') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        <label class="col-sm-6 col-form-label">Potongan Kehadiran</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="attendance_cut" name="cut_attendance"
                                        value="{{ number_format($potonganKehadiran, 0, ',', '.') }}" readonly>
                                </div>
                                @if ($errors->has('cut_attendance'))
                                    <label class="text-danger">
                                        {{ $errors->first('cut_attendance') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label">Bonus Gaji</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="bonus" name="bonus"
                                        oninput="formatNominal(this); hitungTotalGaji()">
                                </div>
                                @if ($errors->has('bonus'))
                                    <label class="text-danger">
                                        {{ $errors->first('bonus') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        <label class="col-sm-6 col-form-label">Potongan Lainnya</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="cut_salary" name="cut_other"
                                        oninput="formatNominal(this); hitungTotalGaji()">
                                </div>
                                @if ($errors->has('cut_other'))
                                    <label class="text-danger">
                                        {{ $errors->first('cut_other') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label">Total Gaji</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="total_salary" name="total_salary"
                                    value="{{ number_format($totalGaji, 0, ',', '.') }}" readonly>
                                </div>
                                @if ($errors->has('total_salary'))
                                    <label class="text-danger">
                                        {{ $errors->first('total_salary') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                        {{-- <label class="col-sm-3 col-form-label">Status Gaji</label>
                        <div class="col-sm-6">
                            <div class="form-group m-0">
                                @if ($employee->salary->status == 'diberikan')
                                    <label class="badge badge-success">Diberikan</label>
                                @elseif ($employee->salary->status == 'belum_diberikan')
                                    <label class="badge badge-danger">Belum diberikan</label>
                                @else
                                    <label class="badge badge-warning">Tidak ada data gaji</label>
                                @endif
                            </div>
                        </div> --}}
                        <div class="col-md-12 mt-5">
                            <a href="{{ route('dashboard-gaji.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Berikan Gaji</button>
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
            // Tambahkan titik sebagai pemisah ribuan
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Fungsi untuk menghitung total gaji
        function hitungTotalGaji() {
            var baseSalary = parseInt(document.querySelector('input[name="base_salary"]').value.replace(/\./g, '')) || 0;
            var fixAllowance = parseInt(document.querySelector('input[name="fix_allowance"]').value.replace(/\./g, '')) || 0;
            var cutInsurance = parseInt(document.getElementById('insurance_cut').value.replace(/\./g, '')) || 0;
            var cutAttendance = parseInt(document.getElementById('attendance_cut').value.replace(/\./g, '')) || 0;
            var bonus = parseInt(document.getElementById('bonus').value.replace(/\./g, '')) || 0;
            var cutOther = parseInt(document.getElementById('cut_salary').value.replace(/\./g, '')) || 0;

            var totalSalary = baseSalary + fixAllowance + bonus - cutInsurance - cutAttendance - cutOther;

            document.getElementById('total_salary').value = totalSalary.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Fungsi untuk menghapus pemisah ribuan sebelum form dikirim
        function prepareFormForSubmission() {
            document.getElementById('insurance_cut').value = document.getElementById('insurance_cut').value.replace(/\./g, '');
            document.getElementById('attendance_cut').value = document.getElementById('attendance_cut').value.replace(/\./g, '');
            document.getElementById('bonus').value = document.getElementById('bonus').value.replace(/\./g, '');
            document.getElementById('cut_salary').value = document.getElementById('cut_salary').value.replace(/\./g, '');
            document.getElementById('total_salary').value = document.getElementById('total_salary').value.replace(/\./g, '');
        }
    </script>

@endsection
