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
                    {{-- <img class="card-img-top" src="{{'images/'. $product->image_url}}" alt="..." /> --}}
                    <img class="card-img-top" src="{{ asset('images/'.$product->image_url) }}" alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $pelatihan->nama }}</h5>
                            <h5 class="fw-bolder">{{ $pelatihan->jadwal_pelatihan }}</h5>
                            @if(str_contains(Auth::user()->role, 'pengajar'))
                            <button onclick="buka_absensi()" style="border: none;"><i class='bx bx-cart'></i></button>
                            <button onclick="lihat_absensi()" style="border: none;"><i class='bx bx-cart'></i></button>
                            @endif
                            @if(str_contains(Auth::user()->role, 'peserta'))
                            <button onclick="do_absensi()" style="border: none;"><i class='bx bx-cart'></i></button>
                            <button onclick="lihat_absensi()" style="border: none;"><i class='bx bx-cart'></i></button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

section('script')
<script>
    // function lihat_absensi(id) {
    //     $.ajax({
    //         type: 'POST',
    //         url: "{{ route('pelatihan.lihat_absensi') }}",
    //         data: {
    //             '_token': '<?php echo csrf_token(); ?>',
    //             'id': id,
    //         },
    //         success: function (data) {
    //             if (data['status'] == 'success') {
    //                 window.location.reload(true);
    //             }
    //         }
    //     });
    // }
</script>