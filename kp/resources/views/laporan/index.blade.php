@extends('layouts.sneat')

@section('menu')

@if(Auth::user() != null)
@if(Auth::user()->role == 'admin')
<div class="modal fade" id="modal-tambah-peserta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah peserta</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('laporan.store') }}" class="col col-6"
                                    method="post">
                                    @csrf
                                    <label for="">Nama peserta</label>
                                    <select name="id_peserta" id="">
                                        @foreach($peserta as $p)
                                        <option value="{{$p->idpeserta}}">{{$p->namapeserta}}</option>
                                        @endforeach
                                    </select>
                                    <div id="tambah-peserta-id-periode"></div>
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                    
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
</div>
<div class="portlet-title">

<div style="float: right; margin: 15px;">
    <button onclick="tambah_peserta( {{$anggota_kelas[0]->idperiode}} )" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>Add</button>
</div>

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

<div style="margin: 15px; font-size: 20px;">
    <strong>List Anggota Kelas {{ $anggota_kelas[0]->namapelatihan }} ({{ $anggota_kelas[0]->kelasparalel }})</strong>
</div>
<div class="table-responsive">
    <table id="pengajar" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nama Peserta</th>
            </tr>
        </thead>
        <tbody>
            @if (count($anggota_kelas) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada anggota kelas yang terdata</td>
            </tr>
            @else
            @foreach ($anggota_kelas as $ak)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ak->namapeserta }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@elseif(Auth::user()->role == 'pengajar')
<div style="margin: 15px; font-size: 20px;">
    <strong>List Laporan Anggota Kelas {{ $anggota_kelas[0]->namapelatihan }} ({{ $anggota_kelas[0]->kelasparalel }})</strong>
</div>
<div class="table-responsive">
    <table id="pengajar" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nama Peserta</th>
                <th>Evaluasi</th>
                <th>Beri Evaluasi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($anggota_kelas) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada anggota kelas yang terdata</td>
            </tr>
            @else
            @foreach ($anggota_kelas as $ak)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ak->namapeserta }}</td>
                @if ($ak->evaluasi == null)
                <td>Belum ada evaluasi</td>
                @else
                <td>{{ $ak->evaluasi }}</td>
                @endif
                <td>
                    <a href="{{ route('laporan.isievaluasi', ['idperiode' => $ak->idperiode, 'idpeserta' => $ak->idpeserta]) }}" class="btn btn-sm btn-primary">Beri Evaluasi</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@elseif(Auth::user()->role == 'orang_tua')

<div class="card">
  <div class="card-body">
    @if ($evaluasi[0]->eval != '')
    <h4 class="card-title"><strong>Evaluasi {{ $evaluasi[0]->namapeserta }} pada {{ $evaluasi[0]->namapelatihan }} ({{ $evaluasi[0]->kelasparalel }})</strong></h4>
    <p class="card-text">Evaluasi: {{ $evaluasi[0]->eval }}</p>
    @else
    <h4 class="card-title"><strong>Evaluasi {{ $evaluasi[0]->namapeserta }} pada {{ $evaluasi[0]->namapelatihan }} ({{ $evaluasi[0]->kelasparalel }})</strong></h4>
    <p class="card-text">Belum ada evaluasi untuk saat ini</p>
    @endif
  </div>
</div>

@endif
@else
<p>Anda tidak memiliki akses halaman ini</p>
@endif
@endsection



@section('script')
<script>
    $(document).ready(function () {
        $('#admin').DataTable({
            "scrollX": true
        });
    });
    function tambah_peserta(idperiode) {
        $("#modal-tambah-peserta").modal("show");
        $("#tambah-peserta-id-periode").html("<input type='hidden' name='idperiode' value='"+idperiode+"' required > ");
    }
</script>
@endsection
