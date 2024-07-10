@php
use Carbon\Carbon;
@endphp
@extends('layouts.sneat')

@section('menu')
<div class="modal fade" id="modal-upload-csv" tabindex="-1" role="dialog" aria-labelledby="uploadCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadCsvModalLabel">Upload CSV</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('orangtua.uploadcsv') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="csv_file" accept=".csv">
                    <input type="submit" value='Upload CSV'>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Orang Tua
    </div>

    @if(str_contains(Auth::user()->role, 'admin'))
    <div style="float: right; margin: 15px;">
        <a href="{{url('orangtua/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
    </div>
    <div style="float: right; margin: 15px;">
        <a href="#" class="btn btn-success btn-sm" onclick="add_upload_csv()"><i class="fa fa-upload"></i>Upload CSV</a>
    </div>
    @endif

</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive">
    <table id="orangtua" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                

                @if(str_contains(Auth::user()->role, 'admin'))
                    <th>Edit</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($orangtua) == 0)
            <tr>
                <td class="text-center" colspan="9">Tidak ada Orang Tua yang terdata</td>
            </tr>
            @else
            
            @foreach ($orangtua as $ot)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ot->nama }}</td>
                <td>{{ $ot->alamat }}</td>
                <td>{{ $ot->email }}</td>
               
                @if(str_contains(Auth::user()->role, 'admin'))
                    <td class="text-center"><a href="{{ route('orangtua.edit', $ot->id) }}"
                        class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                    </td>
                @endif
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
@section('content')



@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#orangtua').DataTable({
            "scrollX": true
        });
    });
    function add_upload_csv() {
        $("#modal-upload-csv").modal("show");
    }
</script>
@endsection
