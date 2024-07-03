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
<form method="POST" action="{{ route('pelatihan.store') }}">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ old('nama') }}">

        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" id="deskripsi" required value="{{ old('deskripsi') }}">

        <label>Jumlah Pertemuan</label>
        <input type="number" name="jumlah_pertemuan" id="" required value="{{ old('jumlah_pertemuan') }}">
        

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
