@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Pelatihan
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<section>
    <div class="container px-2 px-lg-2 mt-2">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($list_pelatihan as $pelatihan)
            <div class="col mb-5">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $pelatihan->nama }}</h5>
                            <h5 class="fw-bolder">{{ $pelatihan->jadwal_pelatihan }}</h5>
                            <hr class="hr" />
                            
                            <button onclick="do_absensi()" style="border: none; background-color:#8080FF">Absensi</button>
                            <button onclick="lihat_absensi()" style="border: none;">Lihat kehadiran</button>


                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@section('script')
<script>

</script>
@endsection