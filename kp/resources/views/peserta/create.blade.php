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
        Add New Peserta
    </div>
</div>
<form method="POST" action="{{route('peserta.store')}}">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ old('nama') }}">

        <label>Umur</label>
        <input type="number" name="umur" class="form-control" id="umur" min="0" max="100" required value="{{ old('umur') }}">

        <label>Orang tua</label>
        <select name="id_orangtua" id="">
            @foreach($orangtua as $o)
                <option value="{{ $o->id }}">{{$o->nama}}</option>
            @endforeach
        </select>
        <br>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection
@section('content')

@endsection
