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
        Edit Pelatihan
    </div>
</div>
<form method="POST" action="{{route('pelatihan.update', $pelatihan->id)}}">
    @csrf
    @method("PUT")
    <div class="form-group">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required value="{{ $pelatihan->nama }}">
            
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" required value="{{ $pelatihan->deskripsi }}">
            
            <label>Jumlah Pertemuan</label>
            <input type="number" name="jumlah_pertemuan" id="" required value="{{ $pelatihan->jumlah_pertemuan }}">
            
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection
@section('content')


@endsection
