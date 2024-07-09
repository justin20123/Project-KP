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
        Add New Anggota Kelas
    </div> 
</div>
@if(Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif
<form method="POST" action="{{ route('jadwalpelatihan.store') }}">
    @csrf
    <div class="form-group">
        <label>Peserta</label>
        <select name="id_peserta" id="">
            @foreach($pengajar as $pj)
                <option value="{{ $pj->id }}">{{$pj->nama}}</option>
            @endforeach
        </select>

    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>

@endsection
<script>

</script>