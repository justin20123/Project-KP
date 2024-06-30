@php
use Carbon\Carbon;
@endphp
@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Orang Tua
    </div>

    @if(str_contains(Auth::user()->role, 'admin'))
    <div style="float: right; margin: 15px;">
        <a href="{{url('orangtua/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
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
                <th>Email</th>
                <th>Nama Peserta</th>

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
                <td>{{ $ot->namaorangtua }}</td>
                <td>{{ $ot->emailorangtua }}</td>
                <td>{{ $ot->namapeserta }}</td>
               
                @if(str_contains(Auth::user()->role, 'admin'))
                    <td class="text-center"><a href="{{ route('orangtua.edit', $ot->idorangtua) }}"
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
</script>
@endsection
