
@extends('layouts.sneat')

@if(Auth::user()->role == 'admin')
@section('menu')
<section>
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
                                    <label for="">Pertemuan ke</label>
                                    <div id="buka-absen-nomor-pertemuan"></div>
                                    <label for="">Pilih jenis pertemuan</label>
                                    <select name="jenis_pertemuan">
                                        <option value="reguler">Reguler</option>
                                        <option value="pengganti">Pengganti</option>
                                    </select>
                                    <div id="buka-absen-id-jadwal-pelatihan"></div>
                                    <input type="submit" value="submit" class="btn btn-primary">
                                    
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
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Jadwal Pelatihan
    </div>

    <div style="float: right; margin: 15px;">
        <a href="{{url('jadwalpelatihan/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
    </div>

</div>
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="table-responsive">
    <table id="pelatihan" class="table table-striped" style="width:100%">
        <thead class="table-border-bottom-0">
            <tr>
                <th>#</th>
                <th>Nama Pelatihan</th>
                <th>Nama Pengajar</th>
                <th>Tanggal Start</th>
                <th>Jenis Pelatihan</th>
                <th>Status</th>
                <th>Jadwal Pelatihan</th>
                <th>Edit</th>
                <th>Buka Absensi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($jadwalpelatihan) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada Jadwal Pelatihan yang terdata</td>
            </tr>
            @else
            @foreach ($jadwalpelatihan as $jp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $jp->namapelatihan }}</td>
                <td>{{ $jp->namapengajar }}</td>
                <td>{{ $jp->tanggal_start }}</td>
                <td>{{ $jp->jenis_pelatihan }}</td>
                <td>{{ $jp->status }}</td>
                <td>{{ $jp->jadwal }}</td>
                    <td class="text-center">
                        <a href="{{ route('jadwalpelatihan.edit', $jp->id) }}" class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                    </td>
                    <td><button onclick='buka_absensi({{ $jp->id }}, {{ $jp->jumlahpertemuan }})' id='btn-buka-absen-{{ $jp->id }}' data-toggle="modal" style="border: none;background-color:#74a7ff"  role="button">Buka Absensi</button></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection




@section('script')
<script>
    $(document).ready(function () {
        $('#pelatihan').DataTable({
            "scrollX": true
        });
    });
    function buka_absensi(idjadwalpelatihan, jumlah_pertemuan) {
        $("#modal-buka-absen").modal("show");
        $("#buka-absen-nomor-pertemuan").html("<input type='number' name='nomor_pertemuan' max="+jumlah_pertemuan+" min=0' required placeholder='Nomor pertemuan'>");
        $("#buka-absen-id-jadwal-pelatihan").html("<input type='hidden' name='idjadwalpelatihan' value='"+idjadwalpelatihan+"' required > ");
    }
</script>
@endsection
@endif