
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {
        $("#juml_pertemuan").append('<input type="hidden" name="jumlahpertemuan" value="0">');
    });
    var count = 1
function addJadwalPertemuan()
    {
        var html = `
        <br>    
        <div>
                <label>Hari</label>
                <select name="hari_pertemuan_` + count + `" id="" required>
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
                <input type="time" name="waktu_awal_pertemuan_` + count + `" id="waktu_awal_pertemuan" placeholder="00.00" required>-
                <input type="time" name="waktu_akhir_pertemuan_` + count + `" id="waktu_akhir_pertemuan" placeholder="00.00" required>
            </div>
        `;
        $('#jadwal-pertemuan').append(html);
        $('#juml_pertemuan').empty();
        $("#juml_pertemuan").append('<input type="hidden" name="jumlahpertemuan" value="'+count+'">');
	count ++
    
    }
    function clearJadwalPertemuan()
    {
        $('#jadwal-pertemuan').html('');
	    count = 1;
        $('#juml_pertemuan').empty();
        $("#juml_pertemuan").append('<input type="hidden" name="jumlahpertemuan" value="0">');
    }
</script>
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Add New Periode
    </div> 
</div>
@if(Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif
<form method="POST" action="{{ route('periode.store') }}">
    @csrf
    <div class="form-group">
        <label for="">Tanggal Start</label>
        <input type="date" id="date" class="form-control" style="width: 20%" name="tanggal_start" value="{{ old('tanggal_start')}}" required>   
        <label for="">Jenis Pelatihan</label>
        <select name="jenis_pelatihan" id="">
            <option value="Kelompok">Kelompok</option>
            <option value="Private">Private</option>
        </select>
        <br>
        <label for="">Kelas Paralel</label>
        <input type="text" name="kelas_paralel" class="form-control" id="kelas_paralel" maxlength="2" size="2" required value="{{ old('kelas_paralel') }}">
        <label>Pengajar</label>
        <select name="id_pengajar" id="">
            @foreach($pengajar as $pj)
                <option value="{{ $pj->id }}">{{$pj->nama}}</option>
            @endforeach
        </select>
        <br>
        <label>Pelatihan</label>
        <select name="idpelatihan" id="">
            @foreach($pelatihan as $pl)
                <option value="{{ $pl->id }}">{{$pl->nama}}</option>
            @endforeach
        </select>
        <br>
        <div id="juml_pertemuan">
        </div>

          
           <label>Jadwal Pertemuan</label>
        <br>
        <label>Hari</label>
        <select name="hari_pertemuan_0" id="" required>
            <option>Pilih Hari Pertemuan</option>
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
        <input type="time" name="waktu_awal_pertemuan_0" id="waktu_awal_pertemuan" placeholder="00.00" required>-
        <input type="time" name="waktu_akhir_pertemuan_0" id="waktu_akhir_pertemuan" placeholder="00.00" required>
        <br>
        <div id="jadwal-pertemuan">
        </div>
        <div class="btn btn-primary" onclick=addJadwalPertemuan()>Tambah Jadwal</div>
        <div class="btn btn-primary" onclick=clearJadwalPertemuan()>Clear jadwal</div>
        
    </div>        

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
