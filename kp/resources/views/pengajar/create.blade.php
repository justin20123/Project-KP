<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
</style>
@extends('layouts.sneat')

@section('menu')
<div class="modal fade" id="modal-upload-csv" tabindex="-1" role="dialog" aria-labelledby="uploadCsvModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadCsvModalLabel">Upload CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('pengajar.upload.csv') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="csv_file" accept=".csv">
                    <button type="submit">Upload CSV</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New Pengajar
    </div>
</div>
<form method="POST" action="{{route('pengajar.store')}}">
    @csrf
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" required value="{{ old('nama') }}">

        <label>Alamat</label>
        <textarea name="alamat" class="form-control" id="alamat" required>"{{ old('alamat') }}"</textarea>
       
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
@section('content')

@endsection
