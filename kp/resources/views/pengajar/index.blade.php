@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Pengajar
    </div>

    @if(str_contains(Auth::user()->role, 'pengajar'))
    <div style="float: right; margin: 15px;">
        <a href="{{ route('pengajar.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Add</a>
    </div>
    @endif

</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div style="margin: 15px; font-size: 20px;">
    <strong>List Pengajar</strong>
</div>
<div class="table-responsive">
    <table id="pengajar" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Last Login</th>
                @if(str_contains(Auth::user()->role, 'pengajar'))
                    <th>Edit</th>
                @endif
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
                <td>{{ $p->umur }}</td>
                <td>{{ $p->last_login }}</td>

                @if(str_contains(Auth::user()->role, 'pengajar'))
                    <td class="text-center"><a href="{{ route('pengajar.edit', $p->id) }}"
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
        $('#pengajar').DataTable({
            "scrollX": true
        });
    });
</script>
@endsection
