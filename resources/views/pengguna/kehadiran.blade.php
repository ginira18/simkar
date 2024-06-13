@extends('layout.template')

@section('title', 'Kehadiran')
@section('content')

    <div class="col-sm-12 grid-margin card rounded" style="height: 100%">
        <div class="card-body">
            <h4 class="card-title">Catatan Kehadiran</h4>
            <form>
                <div class="form-group col-md-5 pl-0 mt-4">
                    {{-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari...."
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button"><i class="icon-magnifier"></i></button>
                        </div>
                    </div> --}}
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Tanggal </th>
                            <th> Status</th>
                            <th> Datang </th>
                            <th> Pulang </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

@endsection
