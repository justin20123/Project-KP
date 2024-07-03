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
        Edit Data Orang Tua
    </div>
</div>
<form method="POST" action="{{ route('orangtua.update', $orangtua->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ $orangtua->nama }}">

        <label>Alamat</label>
        <input type="textarea" name="alamat" class="form-control" id="alamat" required value="{{ $orangtua->alamat }}">


    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

