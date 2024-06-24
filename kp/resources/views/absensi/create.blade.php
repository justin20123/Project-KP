<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Tambah Absensi
    </div>
</div>
<form method="POST" action="{{route('absensi.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        @foreach($absensi as $data => $value)
        <input type="text" name="{{ $data }}" value="{{ $value }} ">
        @endforeach
        <select name="jenis_pertemuan">
            <option value="reguler">Reguler</option>
            <option value="pengganti">Pengganti</option>
        </select>


    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

