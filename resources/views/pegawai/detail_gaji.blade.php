@extends('pegawai.template')

@section('title', 'Detail Gaji Karyawan')
@section('content')

<div class="col-sm-12 grid-margin card rounded">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Gaji Karyawan</h4>

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

            <div class="row">
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
                            <p class="py-3">: {{ $salaryHistory->employee->name }}</p>
                            <p class="py-3">: {{ $salaryHistory->employee->NIP }}</p>
                            <p class="py-3">: {{ $salaryHistory->employee->department->name }}</p>
                            <p class="py-3">: {{ $salaryHistory->employee->position }}</p>
                            <p class="py-3">: {{ $salaryHistory->employee->employee_type == 'monthly' ? 'Bulanan' : 'Harian' }}</p>
                            <p class="py-3">: Rp.<span id="base_salary">{{ number_format($salaryHistory->base_salary, 0, ',', '.') }}</span></p>
                            <p class="py-3">: Rp.<span id="fix_allowance">{{ number_format($salaryHistory->fix_allowance, 0, ',', '.') }}</span></p>
                            <p class="py-3">
                                @if ($salaryHistory->employee->bpjs == 'bpjs')
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
                                    value="{{ number_format($salaryHistory->cut_insurance, 0, ',', '.') }}" readonly>
                            </div>
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
                                    value="{{ number_format($salaryHistory->cut_attendance, 0, ',', '.') }}" readonly>
                            </div>
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
                                    value="{{ number_format($salaryHistory->bonus, 0, ',', '.') }}" readonly>
                            </div>
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
                                    value="{{ number_format($salaryHistory->cut_other, 0, ',', '.') }}" readonly>
                            </div>
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
                                value="{{ number_format($salaryHistory->total_salary, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <a href="{{ route('gaji-karyawan') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('gaji.slip', $salaryHistory->id) }}" class="btn btn-primary">Lihat Slip Gaji</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
