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
                                <th> Status Gaji </th>
                                <th class="pl-5"> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->NIP }}</td>
                                    <td>{{ $employee->department->name }}</td>
                                    <td>
                                        @if ($employee->employee_type == 'monthly')
                                            Bulanan
                                        @elseif ($employee->employee_type == 'daily')
                                            Harian
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employee->salary->status == 'diberikan')
                                            <label class="badge badge-success">Diberikan</label>
                                        @elseif ($employee->salary->status == 'belum_diberikan')
                                            <label class="badge badge-danger">Belum diberikan</label>
                                        @else
                                            <label class="badge badge-warning">Tidak ada data gaji</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('salary.show', $employee->id) }}" class="btn btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    {{-- modal gaji --}}
    {{-- <div class="modal fade" id="gaji" tabindex="-1" role="dialog" aria-labelledby="gaji" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div>
                    <button type="button" class="close p-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="col-sm-12">
                            <label class="col-sm-6 col-form-label">Total Gaji</label>
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <label class="col-sm-6 col-form-label">Bonus Gaji </label>
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <button type="button" class="btn btn-primary">Berikan Gaji</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
