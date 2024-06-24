@extends('layouts.sneat')

@section('content')
<div class="modal fade" id="modal-buka-absensi" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true"></button>
                                <h4 class="modal-title">Modal update 1</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="buka_absensi">Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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
                            
                            @if(str_contains(Auth::user()->role, 'pengajar'))
                            <button onclick="formBukaAbsensi({{ $pelatihan->id }})" style="border: none; background-color:#8080FF">Buka absensi</button>
                            <button onclick="lihat_absensi('peserta')" style="border: none;">Lihat absensi</button>
                            <hr class="hr" />

                            <button onclick="tutup_absensi()" style="border: none;background-color:#ff0103 ">Tutup absensi</button>
                            @endif
                            @if(str_contains(Auth::user()->role, 'peserta'))
                            <button onclick="do_absensi()" style="border: none; background-color:#8080FF">Absen</button>
                            <button onclick="lihat_absensi('peserta')" style="border: none;">Lihat kehadiran</button>
                            @endif


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
    jQuery(document).ready(function() {
        App.init();
        $("#buka_absensi").on("click", function() {
                $("#form-buka-absensi").submit();
            });

            
    })
    function formBukaAbsensi(id) {
        $.ajax({
            type:"POST",
            url:{{route('absensi.bukaAbsensiForm')}}
            data:{
                "_token":"<?php echo csrf_token() ?>",
                "idpelatihan":id
            },
            success:function(data){
                $("#modal-buka-absensi.modal-body").html(data);
                $("#modal-buka-absensi").modal("show");
            }
        })
            $.get("{{ url('buka_absensi') }}/" + id,
                function(data) {
                    $("#modal-buka-absensi .modal-body").html(data);
                    $("#modal-buka-absensi").modal("show");
                },
            );
        }
 function buka_absensi(nomor_angkatan, idpelatihan) {
        $.ajax({
            type: 'GET',
            url: "{{ route('absensi.create') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'nomor_angkatan': nomor_angkatan,
                'idpelatihan': idpelatihan,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }
</script>
@endsection