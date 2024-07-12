<style>
    label{
        margin-top: 15px;
        margin-bottom: 10px;
        color: black;
    }
    .picker{
        width: 20%;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Edit Periode
    </div> 
</div>
@if(Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif
<form method="POST" action="{{ route('periode.update', $periode->id) }}">
    @csrf
    @method("PUT")
    <div class="form-group">          
        <label>Jadwal Pertemuan</label>
        <br>
        <label>Hari</label>
        <select name="hari_pertemuan" id="" required>
            <option value="">Pilih Hari Pertemuan</option>
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
        <input type="time" name="waktu_awal_pertemuan" id="waktu_awal_pertemuan" placeholder="00.00" required>-
        <input type="time" name="waktu_akhir_pertemuan" id="waktu_akhir_pertemuan" placeholder="00.00" required>
        
        

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
<script>


</script>