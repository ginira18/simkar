@extends ('admin.layout.template')

@section('title', 'Hari Libur')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h4 class="card-title">Pilih Tanggal</h4>

                        <div class="row justify-content-end">
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="" name=""
                                placeholder="dd/mm/yyyy" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card rounded">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Hari Libur</h4>
                        <div class="mt-5">
                            <table class="table table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Tgl Libur </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td> 19 </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
