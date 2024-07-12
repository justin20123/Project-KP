@extends('layouts.sneat')

@section('menu')
<div class="modal fade" id="modal-upload-csv" tabindex="-1" role="dialog" aria-labelledby="uploadCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadCsvModalLabel">Upload CSV</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pengajar.uploadcsv') }}" enctype="multipart/form-data">
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
        List Pengajar
    </div>

    @if(str_contains(Auth::user()->role, 'admin'))
    <div style="float: right; margin: 15px;">
        <a href="{{ url('pengajar/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Add</a>
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
    <table id="pengajar" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Last Login</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @if (count($pengajar) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada Pengajar yang terdata</td>
            </tr>
            @else
            @foreach ($pengajar as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->last_login }}</td>

            
                <td class="text-center"><a href="{{ route('pengajar.edit', $p->id) }}"
                        class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                </td>

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
        $('#pengajar').DataTable({
            "scrollX": true
        });
    });
    function add_upload_csv() {
        $("#modal-upload-csv").modal("show");
    }
</script>
@endsection
