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
        Edit Data Admin
    </div>
</div>
@endsection
@section('content')
<form method="POST" action="{{route('admin.update', $user->id)}}">
    @csrf
    @method("PUT")
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ $user->nama }}">

        <label>Alamat</label>
        <textarea name="alamat" class="form-control" id="alamat" required>{{ $user->alamat }}</textarea>    

        <label>Umur</label>
        <input type="number" name="umur" class="form-control" id="umur" max="100" min="0" required value="{{ $user->umur }}">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
