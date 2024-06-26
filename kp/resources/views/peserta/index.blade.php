@php
use Carbon\Carbon;
@endphp
@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Peserta
    </div>

    @if(str_contains(Auth::user()->role, 'admin'))
    <div style="float: right; margin: 15px;">
        <a href="{{url('peserta/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
    </div>
    @endif

</div>
@endsection
@section('content')

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive">
    <table id="peserta" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Umur</th>
                @if(str_contains(Auth::user()->role, 'admin'))
                    <th>Edit</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($peserta) == 0)
            <tr>
                <td class="text-center" colspan="9">Tidak ada Peserta yang terdata</td>
            </tr>
            @else
            
            @foreach ($peserta as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->umur }}</td>

                @if(str_contains(Auth::user()->role, 'admin'))
                    <td class="text-center"><a href="{{ route('peserta.edit', $p->id) }}"
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


@section('script')
<script>
    $(document).ready(function () {
        $('#peserta').DataTable({
            "scrollX": true
        });
    });
</script>
@endsection
