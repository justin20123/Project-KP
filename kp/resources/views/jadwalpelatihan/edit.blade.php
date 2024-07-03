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

@extends('layouts.sneat')

@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New  Jadwal Pelatihan
    </div> 
</div>
@if(Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif
<form method="POST" action="{{ route('jadwalpelatihan.update', $jadwalpelatihan->id) }}">
    @csrf
    @method("PUT")
    <div class="form-group">
        <label for="">Tanggal Start</label>
        <input type="date" id="date" class="form-control" style="width: 20%" name="tanggal_start" value="{{ $jadwalpelatihan->tanggal_start }}">   
        <label for="">Jenis Pelatihan</label>
        <select name="jenis_pelatihan" id="" required>
            <option value="Kelompok">Kelompok</option>
            <option value="Private">Private</option>
        </select>
        <br>
        <label>Pengajar</label>
        <select name="id_pengajar" id="" required>
            @foreach($pengajar as $pj)
                @if($pj->id == $jadwalpelatihan->id_pengajar)
                    <option value="{{ $pj->id }}" selected>{{$pj->nama}}</option>
                @else
                    <option value="{{ $pj->id }}">{{$pj->nama}}</option>
                @endif               
            @endforeach
        </select>
        <br>
        <label>Pelatihan</label>
        <select name="idpelatihan" id="" required>
            @foreach($pelatihan as $pl)
            @if($pl->id == $jadwalpelatihan->idpelatihan)
            <option value="{{ $pl->id }}" selected>{{$pl->nama}}</option>
        @else
            <option value="{{ $pl->id }}">{{$pl->nama}}</option>
        @endif
            @endforeach
        </select>
        <br>

          
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
        <input type="text" name="waktu_awal_pertemuan" id="" placeholder="00.00"> - <input type="text" name="waktu_akhir_pertemuan" id="" placeholder="00.00">
        

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
<script>

</script>