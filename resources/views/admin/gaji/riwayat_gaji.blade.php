@extends('admin.layout.template')

@section('title', 'Riwayat Gaji')
@section('content')

    <div class="col-sm-12 grid-margin card rounded">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Riwayat Gaji Karyawan</h4>
                <form>
                    <table class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIP </th>
                                <th> Bagian </th>
                                <th> Jenis Karyawan </th>
                                <th> Periode Gaji</th>
                                <th class="pl-5"> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaryHistories as $salaryHistory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $salaryHistory->employee->name }}</td>
                                    <td>{{ $salaryHistory->employee->NIP }}</td>
                                    <td>{{ $salaryHistory->employee->department->name }}</td>
                                    <td>
                                        @if ($salaryHistory->employee->employee_type == 'monthly')
                                            Bulanan
                                        @elseif ($salaryHistory->employee->employee_type == 'daily')
                                            Harian
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($salaryHistory->created_at)->format('F') }}
                                    {{-- <td>{{ Carbon::parse($salaryHistory->month)->format('F Y') }}</td> --}}

                                    <td>
                                        <a href="{{ route('salary.show', $salaryHistory->id) }}"
                                            class="btn btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

@endsection
