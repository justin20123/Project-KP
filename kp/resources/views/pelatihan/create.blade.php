<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New Pelatihan
    </div> 
</div>
@if(Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif
@endsection
@section('content')
<form method="POST" action="{{ route('pelatihan.store') }}">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="pelatihan" class="form-control" id="pelatihan" required value="{{ old('pelatihan') }}">

        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" id="deskripsi" required value="{{ old('deskripsi') }}">

        <label>Jadwal Pertemuan</label>
        <input type="text" name="jadwal_pertemuan" class="form-control" id="jadwal_pertemuan" required value="{{ old('jadwal_pertemuan') }}">

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection