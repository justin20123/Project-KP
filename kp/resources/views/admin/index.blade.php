@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Admin
    </div>

    @if(str_contains(Auth::user()->role, 'admin'))
    <div style="float: right; margin: 15px;">
        <a href="{{ route('admin.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
    </div>
    @endif

</div>
@endsection

@section('content')

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div style="margin: 15px; font-size: 20px;">
    <strong>List Admin Aktif</strong>
</div>
<div class="table-responsive">
    <table id="adminAktif" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Last Login</th>
                @if(str_contains(Auth::user()->role, 'admin'))
                    <th>Edit</th>
                    <th>Non Aktifkan</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($adminAktif) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada Admin yang terdata</td>
            </tr>
            @else
            @foreach ($adminAktif as $aktif)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aktif->nama }}</td>
                <td>{{ $aktif->alamat }}</td>
                <td>{{ $aktif->email }}</td>
                <td>{{ $aktif->umur }}</td>
                <td>{{ $aktif->last_login }}</td>

                @if(str_contains(Auth::user()->role, 'admin'))
                    <td class="text-center"><a href="{{ route('admin.edit', $aktif->id) }}"
                            class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                    </td>
                    <td class="text-center"><button onclick="nonaktifkan({{ $aktif->id }})"
                            class="btn btn-sm btn-danger"><i class='bx bx-power-off'></i></button>
                    </td>
                @endif
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<br><br>
<div>
    <div style="margin: 15px; font-size: 20px;">
        <strong>List Admin Nonaktif</strong>
    </div>
    <table id="adminNonAktif" class="table table-striped" style="width:100%">
        <thead>
        @if (count($adminNonaktif) == 0)
        <tr>
            <td class="text-center" colspan="8">Tidak ada Admin yang terdata</td>
        </tr>
        @else
        <tr>
            <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Last Login</th>
            @if(str_contains(Auth::user()->role, 'admin'))
                <th>Edit</th>
                <th>Aktifkan</th>
            @endif
        </tr>
        @endif
    </thead>
    <tbody>
        @foreach ($adminNonaktif as $nonAktif)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $nonAktif->nama }}</td>
            <td>{{ $nonAktif->alamat }}</td>
            <td>{{ $nonAktif->email }}</td>
            <td>{{ $nonAktif->umur }}</td>
            <td>{{ $nonAktif->last_login }}</td>
            @if(str_contains(Auth::user()->role, 'admin'))
                <td class="text-center"><a href="{{ route('admin.edit', $nonAktif->id) }}"
                        class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                </td>
                <td class="text-center"><button onclick="aktifkan({{ $nonAktif->id }})"
                        class="btn btn-sm btn-success"><i class='bx bx-power-off'></i></button>
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#adminAktif').DataTable({
            "scrollX": true
        });
        $('#adminNonAktif').DataTable({
            "scrollX": true
        });
    });

    function nonaktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.nonaktifkan') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function aktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.aktifkan')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }
</script>
@endsection
