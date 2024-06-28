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
@endsection
@section('content')

<form method="POST" action="{{ route('peserta.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ $user->nama }}">

        <label>Alamat</label>
        <textarea name="alamat" class="form-control" id="alamat" required>{{ $peserta->alamat }}</textarea>

        <label>Umur</label>
        <input type="text" name="umur" class="form-control" id="umur" required value="{{ $user->umur }}">

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>


@endsection
