<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layout.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Edit Pelatihan
    </div>
</div>
@endsection
@section('content')
<form method="POST" action="{{route('pelatihan.update', $pelatihan->id)}}">
    @csrf
    @method("PUT")
    <div class="form-group">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="pelatihan" class="form-control" id="pelatihan" required value="{{ $pelatihan->nama}}">
    
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" id="deskripsi" required value="{{ $pelatihan->deskripsi}}">

            <label>Total Pertemuan</label>
            <input type="number" min="0" step = "1" name="totalPertemuan" class="form-control" id="totalPertemuan" required value="{{ $pelatihan->total_pertemuan}}">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
    </div>
</form>

@endsection
