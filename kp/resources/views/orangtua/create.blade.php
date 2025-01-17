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
        Add New Orang Tua
    </div>
</div>
<form method="POST" action="{{route('orangtua.store')}}">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ old('nama') }}">

        <label>Alamat</label>
        <input type="textarea" name="alamat" class="form-control" id="alamat" required value="{{ old('alamat') }}">

        <label>Email</label>
        <input type="email" name="email" class="form-control" id="email" required value="{{ old('email') }}">

        <label>Password</label>
        <input type="password" name="password" class="form-control" id="password" required value="{{ old('password') }}">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>
@endsection

