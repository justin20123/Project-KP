
@extends('layouts.sneat')


@if((Auth::user()->role == 'peserta') || (Auth::user()->role == 'pengajar'))
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<section>
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

<div class="modal fade" id="modal-do-absen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Absen</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('absensi.doAbsensi') }}" class="col col-6"
                                    method="post">
                                    @csrf'
                                    <input type="hidden" name="" id="do-absen-id-absensi">
                                    <label for="">Absen anda akan tersimpan</label>
                                    <input type="submit" value="ok" class="btn btn-primary">
                                    
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
</div>
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
            
            @foreach ($pelatihan as $p)
            <div class="col mb-5">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $p->nama }}</h5>
                            <h5 class="fw-bolder">{{ $p->jadwal_pelatihan }}</h5>
                            <hr class="hr" />
                            
                            @if(str_contains(Auth::user()->role, 'pengajar'))
                            <button onclick='buka_absensi({{ $p->nomor_angkatan }}, {{ $p->id }})' id='btn-buka-absen-{{ $p->id }}' data-toggle="modal" style="border: none;background-color:#74a7ff"  role="button">Buka Absensi</button>
                            {{-- <button onclick="formBukaAbsensi({{ $pelatihan->id }})" >Buka absensi</button> --}}
                            <button onclick="lihat_absensi('peserta')" style="border: none;">Lihat absensi</button>
                            <hr class="hr" />

                            <button onclick="tutup_absensi()" style="border: none;background-color:#ff0103 ">Tutup absensi</button>
                            @endif
                            @if(str_contains(Auth::user()->role, 'peserta'))
                            <button onclick="do_absensi( {{ $p->id }} )" style="border: none; background-color:#8080FF">Absen</button>
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

    function do_absensi(idabsensi) {
        $("#do-absen-id-absensi").html("<input type='hidden' name='idabsensi' value='"+idabsensi+"'>");
        $("#modal-do-absen").modal("show");
    }
</script>
@endsection
@endif

@if(Auth::user()->role == 'admin')

@section('content')

@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive">
    <table id="pelatihan" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Nomor Pertemuan</th>
                <th>Jadwal Pelatihan</th>
                <th>Nomor Angkatan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @if (count($pelatihan) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada Pelatihan yang terdata</td>
            </tr>
            @else
            @foreach ($pelatihan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td>{{ $p->jadwal_pelatihan }}</td>
                <td>{{ $p->nomor_angkatan }}</td>
                    <td class="text-center"><a href="{{ route('pelatihan.edit', $p->id) }}"
                        class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                    </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Pelatihan
    </div>

    <div style="float: right; margin: 15px;">
        <a href="{{url('pelatihan/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
    </div>

</div>
@endsection




@section('script')
<script>
    $(document).ready(function () {
        $('#pelatihan').DataTable({
            "scrollX": true
        });
    });
</script>
@endsection
@endif