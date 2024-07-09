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
        Edit Evaluasi
    </div>
</div>
<form method="POST" action="{{route('laporan.updateevaluasi')}}">
    @csrf
    @method("PUT")
    <div class="form-group">
        <div class="form-group">
            <label>Pelatihan: {{ $periode->namapelatihan }} ({{ $periode->kelasparalel }})</label>
            <input type="hidden" name="idperiode" class="form-control" required value="{{ $periode->idperiode }}">
            <br>
            <label>Nama: {{ $peserta->nama }}</label>
            <input type="hidden" name="idpeserta" class="form-control" required value="{{ $peserta->id }}">
            <br>
            <label>Evaluasi</label>
            <input type="text" name="evaluasi" class="form-control" required value="{{ $laporan->evaluasi }}">

            
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection
@section('content')


@endsection
