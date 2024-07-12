@extends('layouts.sneat')

@section('menu')
@if(Auth::user() != null && Auth::user()->role == 'pengajar')
<div class="modal fade" id="modal-hadir-semua" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Catat Hadir Semua</h4>
                                <p>Apakah anda yakin akan menjadikan semua peserta kelas ini hadir</p>
                                <small>Anda masih dapat mengubah data setiap peserta setelah ini</small>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('absensi.hadirsemua') }}" class="col col-6"
                                    method="post">
                                    @csrf
                                    <div id="id-jadwalkelas-hadir"></div>
                                    <div id="id-periode-hadir"></div>
                                    <input type="submit" value="submit" class="btn btn-primary">
                                    
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
</div>
<div class="modal fade" id="modal-alfa-semua" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Catat Alfa Semua</h4>
                <p>Apakah anda yakin akan menjadikan semua peserta kelas ini alfa</p>
                <small>Anda masih dapat mengubah data setiap peserta setelah ini</small>
            </div>
            <div class="modal-body">
                <form action="{{ route('absensi.alfasemua') }}" class="col col-6"
                    method="post">
                    @csrf
                    <div id="id-jadwalkelas-alfa"></div>
                    <div id="id-periode-alfa"></div>
                    <input type="submit" value="submit" class="btn btn-primary">
                    
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

@if(session("message"))
<div class="alert alert-success  alert-dismissible fade show" role="alert">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>{{ session("message") }}</strong> 
</div>
@endif
@if (count($peserta) == 0)
<p>Tidak ada data absensi ditemukan</p>
@else
<div style="margin: 15px; font-size: 20px;">
    <strong>List Kehadiran {{ $peserta[0]->namapelatihan }} ({{ $peserta[0]->kelasparalel }})</strong>
    

</div>
@foreach ($jadwalkelas as $jk)
<div class="card">
    <img class="card-img-top" src="holder.js/100x180/" alt="">
    <div class="card-body">
        <div class="card-title">
            <h4>Pertemuan ke {{ $jk->nomor_pertemuan }}</h4>
            <button onclick="hadir_semua( {{$jk->id}} , {{$jk->idperiode}})" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Update Semua Peserta Hadir</button>
            <button onclick="alfa_semua( {{$jk->id}} ,  {{$jk->idperiode}} )" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Update Semua Peserta Alfa</button>
            <a href="{{ route('absensi.edit_absensi', $jk->id ) }}" class="btn btn-primary">Edit absensi</a>
        </div>
        <div class="card-text">
            <div class="table-responsive">
                <table id="pengajar" class="table table-striped" style="width:100%">
                    <thead class="table-border-bottom-0">
                        <tr>
                            <th>#</th>
                            <th>Nama Peserta</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($peserta) == 0)
                        <tr>
                            <td class="text-center" colspan="8">Tidak ada anggota kelas yang terdata</td>
                        </tr>
                        @else
                        @foreach ($peserta as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->namapeserta }}</td>
                            <td>{{ $p->status_kehadiran }}</td>


                        </tr>
                        @endforeach
                    
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endforeach
@endif
@elseif(Auth::user() != null && Auth::user()->role == 'orang_tua')

@if (count($peserta) == 0)
<p>Tidak ada data absensi ditemukan</p>
@elseif (count($peserta) > 0)
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Kehadiran {{ $peserta[0]->namapeserta }} pada {{ $peserta[0]->namapelatihan }} ({{ $peserta[0]->kelasparalel }})
    </div>
</div>
<div class="table-responsive">
    <table id="pengajar" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nomor Pertemuan</th>
                <th>Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @if (count($peserta) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada anggota kelas yang terdata</td>
            </tr>
            @else
            @foreach ($peserta as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nomorpertemuan }}</td>
                <td>{{ $p->status_kehadiran }}</td>


            </tr>
            @endforeach
        
            @endif
        </tbody>
    </table>
</div>
@endif
@endif
@endsection

@section('content')


@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#admin').DataTable({
            "scrollX": true
        });
    });
    function hadir_semua(idjadwalkelas, idperiode) {
        $("#modal-hadir-semua").modal("show");
        $("#id-jadwalkelas-hadir").html("<input type='hidden' name='idjadwalkelas' value='"+idjadwalkelas+"' required > ");
        $("#id-periode-hadir").html("<input type='hidden' name='idperiode' value='"+idperiode+"' required > ");
    }

    function alfa_semua(idjadwalkelas, idperiode) {
        $("#modal-alfa-semua").modal("show");
        $("#id-jadwalkelas-alfa").html("<input type='hidden' name='idjadwalkelas' value='"+idjadwalkelas+"' required > ");
        $("#id-periode-alfa").html("<input type='hidden' name='idperiode' value='"+idperiode+"' required > ");
    }
</script>
@endsection
