@extends ('layout.template')

@section('title', 'Detail Karyawan')
@section('content')
    <div class="d-md-flex row m-2 quick-action-btns">
        <div class=" card col-md-5 m-5 p-3 text-center rounded bg-success">
            <a href="pengaturan_hari_libur" type="button" class="btn p-0"><i class="icon-check mr-2"></i> Hari Libur</a>
        </div>
        <div class=" card col-md-5 m-5 p-3 text-center rounded bg-primary">
            <a href="/daftar_bagian_karyawan" type="button" class="btn p-0"><i class="icon-envelope-letter mr-2"></i> Daftar
                Bagian</a>

        </div>
        {{-- <div class=" card col-md-3 m-5 p-3 text-center btn-wrapper rounded bg-primary">
            <button type="button" class="btn p-0" onclick="window.location.href='/riwayat_kehadiran'"><i
                    class="icon-notebook mr-2"></i> Riwayat Karyawan</button>
        </div> --}}
    </div>

    <div class="card mt-3 rounded">
        <h4 class="card-title mt-4 ml-3">Daftar Karyawan Non-Aktif</h4>
        <table class="table table-border table-hover">
            <thead>
                <tr class="text-center">
                    <th class="py-4  font-weight-bold">No</th>
                    <th class="py-4 font-weight-bold">Nama</th>
                    <th class="py-4 font-weight-bold">NIP</th>
                    <th class="py-4 font-weight-bold">Bagian</th>
                    <th class="py-4 font-weight-bold">Jabatan</th>
                    <th class="py-4 font-weight-bold">Status</th>
                    <th class="py-4 font-weight-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>Gilang Nico Raharjo </td>
                        <td>1234565432</td>
                        <td>Marketing</td>
                        <td>Kepala</td>
                        <td><label class="badge badge-danger">Non-Aktif</label></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-icon-text"
                                onclick="window.location.href='/pengaturan_detail_karyawan'">
                                <i class="icon-info btn-icon-prepend"></i> Detail </button>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
