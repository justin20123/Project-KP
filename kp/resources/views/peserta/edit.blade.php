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
        Edit Data Peserta
        <small>Untuk data orang tua bisa diedit pada bagian list orang tua</small>
    </div>
</div>
<form method="POST" action="{{ route('peserta.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ $user->nama }}">

        <label>Umur</label>
        <input type="number" name="umur" class="form-control" id="umur" min="0" max="100" required value="{{ $ser->umur }}">

        <label for="">Orang tua</label>
        <select name="id_orangtua" id="" required>
            @foreach($orangtua as $o)
            @if($peserta->id_orangtua == $o->id)
            <option value="{{ $o->id }}" selected>{{$o->nama}}</option>
        @else
            <option value="{{ $o->id }}">{{$o->nama}}</option>
        @endif
            @endforeach
        </select>
        <br>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection
@section('content')




@endsection
