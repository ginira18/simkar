@extends('pegawai.template')

@section('title', 'Gaji Karyawan')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Gaji Karyawan</h4>

                <form method="GET" action="{{ route('gaji-karyawan') }}" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="month">Bulan</label>
                            <select id="month" name="month" class="form-control">
                                <option value="" {{ $selectedMonth === null ? 'selected' : '' }}>Semua</option>
                                @foreach (range(1, 12) as $monthOption)
                                    <option value="{{ $monthOption }}"
                                        {{ $selectedMonth == $monthOption ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($monthOption)->locale('id')->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="year">Tahun</label>
                            <select id="year" name="year" class="form-control">
                                @foreach (range(date('Y') - 5, date('Y')) as $yearOption)
                                    <option value="{{ $yearOption }}"
                                        {{ $selectedYear == $yearOption ? 'selected' : '' }}>
                                        {{ $yearOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>


                <table class="table table-striped mt-5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Total Gaji</th>
                            <th class="pl-5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryHistories as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($history->created_at)->locale('id')->translatedFormat('F Y') }}
                                </td>
                                <td>Rp. {{ number_format($history->total_salary, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('detail-gaji-karyawan', $history->id) }}"
                                        class="btn btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-end">
                    {{ $salaryHistories->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
