@extends('layouts.sneat')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="modal fade" id="modal-buka-absen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Buka Absensi</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('absensi.store') }}" class="col col-6"
                                    method="post">
                                    @csrf
                                    <div id="buka-absen-nomor-angkatan"></div>
                                    <label for="">Pilih jenis pertemuan</label>
                                    <select name="jenis_pertemuan">
                                        <option value="reguler">Reguler</option>
                                        <option value="pengganti">Pengganti</option>
                                    </select>
                                    <button id="cancel-buka-absen">Close</button>
                                    <div id="buka-absen-id-pelatihan"></div>
                                    <input type="submit" value="submit" class="btn btn-primary">
                                    
                                </form>
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
    @if(session("message"))
            <div class="alert alert-success  alert-dismissible fade show" role="alert">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>{{ session("message") }}</strong> 
            </div>
            @endif
            @if(session("error") != null)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>{{ session("error") }}</strong> 
            </div>
            @endif
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
                            <button onclick='buka_absensi({{ $pelatihan->nomor_angkatan }}, {{ $pelatihan->id }})' id='btn-buka-absen-{{ $pelatihan->id }}' data-toggle="modal" style="border: none;background-color:#74a7ff"  role="button">Buka Absensi</button>
                            {{-- <button onclick="formBukaAbsensi({{ $pelatihan->id }})" >Buka absensi</button> --}}
                            <button onclick="lihat_absensi('peserta')" style="border: none;">Lihat absensi</button>
                            <hr class="hr" />

                            <button onclick="tutup_absensi()" style="border: none;background-color:#ff0103 ">Tutup absensi</button>
                            @endif
                            @if(str_contains(Auth::user()->role, 'peserta'))
                            <button onclick="do_absensi( {{ $pelatihan->id }} )" style="border: none; background-color:#8080FF">Absen</button>
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
<script src="{{ asset('assets/scripts/app.js') }}"></script>
<script>

    function closeBukaAbsenModal(){
        $("#modal-buka-absen").modal("hide");
    }
    function formBukaAbsensi(id) {

            $.get("{{ url('buka_absensi') }}/" + id,
                function(data) {
                    $("#modal-buka-absensi .modal-body").html(data);
                    $("#modal-buka-absensi").modal("show");
                },
            );
        }
    function buka_absensi(nomor_angkatan, idpelatihan) {
        $("#buka-absen-nomor-angkatan").html("<input type='hidden' name='nomor_angkatan' value='"+nomor_angkatan+"'>");
        $("#modal-buka-absen").modal("show");
        $("#buka-absen-id-pelatihan").html("<input type='hidden' name='id_pelatihan' value='"+idpelatihan+"'>");
    }

    function do_absensi(id) {
        $.ajax({
                type: 'POST',
                url: "{{ route('absensi.doAbsensi') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                },
            });
    }
</script>
@endsection