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
            <input type="text" name="pelatihan" class="form-control" id="pelatihan" required value="{{ $pelatihan->nama}}">
    
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" required value="{{ $pelatihan->deskripsi}}">
            <label>Hari</label>
        <select name="hari_pertemuan" id="" required>
            <option>Pilih Hari Pertemuan</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
        </select>
        <br>
        <label>Waktu</label>
        <input type="text" name="waktu_awal_pertemuan" id="" placeholder="00.00"> - <input type="text" name="waktu_akhir_pertemuan" id="" placeholder="00.00">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
    </div>
</form>
@endsection
@section('content')


@endsection
