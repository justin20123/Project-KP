
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
                                <form action="{{ route('jadwalkelas.store') }}" class="col col-6"
                                    method="post">
                                    @csrf
                                    <label for="">Pertemuan ke</label>
                                    <div id="buka-absen-nomor-pertemuan"></div>
                                    <label for="">Pilih jenis pertemuan</label>
                                    <select name="jenis_pertemuan">
                                        <option value="reguler">Reguler</option>
                                        <option value="pengganti">Pengganti</option>
                                    </select>
                                    <div id="buka-absen-id-periode"></div>
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
        List Periode
    </div>

    <div style="float: right; margin: 15px;">
        <a href="{{url('periode/create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
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
                <th>Kelas Paralel</th>
                <th>Status</th>
                <th>Jadwal Pelatihan</th>
                <th>Edit</th>
                <th>Buka Absensi</th>
                <th>Lihat Anggota</th>
            </tr>
        </thead>
        <tbody>
            @if (count($periode) == 0)
            <tr>
                <td class="text-center" colspan="8">Tidak ada Jadwal Pelatihan yang terdata</td>
            </tr>
            @else
            @foreach ($periode as $periode)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $periode->namapelatihan }}</td>
                <td>{{ $periode->namapengajar }}</td>
                <td>{{ $periode->tanggal_start }}</td>
                <td>{{ $periode->jenis_pelatihan }}</td>
                <td>{{ $periode->kelas_paralel }}</td>
                <td>{{ $periode->status }}</td>
                <td>{{ $periode->jadwal }}</td>
                    <td class="text-center">
                        <a href="{{ route('periode.edit', $periode->id) }}" class="btn btn-sm btn-primary"><i class='bx bx-edit-alt'></i></a>
                    </td>
                    <td><button onclick='buka_absensi({{ $periode->id }}, {{ $periode->jumlahpertemuan }})' id='btn-buka-absen-{{ $periode->id }}' data-toggle="modal" style="border: none;background-color:#74a7ff"  role="button">Buka Absensi</button></td>
                    <td><a href="{{route('laporan.daftarpeserta', $periode->id )}}" class="btn btn-success btn-sm">Lihat Anggota</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@endif

@if(Auth::user()->role == 'pengajar')
@section('menu')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Periode
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

@foreach ($periode as $p)
<div class="col mb-5">
    <div class="card h-100">
        <div class="card-body p-4">
            <div class="text-center">
                <h5 class="fw-bolder">{{ $p->namapelatihan }}</h5>
                <h5 class="fw-bolder">{{ $p->jadwal }}</h5>
                <hr class="hr" />
                
                <a href="{{route('absensi.lihat_absensi', $p->id )}}" class="btn btn-success btn-sm">Lihat kehadiran</a>
                <hr class="hr" />

                <a href="{{route('laporan.daftarpeserta', $p->id )}}" class="btn btn-success btn-sm">Lihat Evaluasi</a>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
</div>
@endif

@if(Auth::user()->role == 'orang_tua')
@section('menu')
@foreach($peserta as $keype=>$pe)
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        Data Pelatihan {{ $pe->nama }}
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
<div class="container">
    <div class="justify-content-center">

        @if(count($periode[$keype])==0)
            <p>Tidak ada data tersedia</p>
        @else
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bolder">Berjalan</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pelatihan</th>
                            <th>Jadwal</th>
                            <th>Lihat Kehadiran</th>
                            <th>Lihat Evaluasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periode[$keype]['periodejalan'] as $p)
                        <tr>
                            <td>{{ $p->namapelatihan }}</td>
                            <td>{{ $p->jadwal }}</td>
                            <td><a href="{{ url('./lihat_absensi/'. $p->id. '/'. $p->idpeserta) }}" class="btn btn-success btn-sm">Lihat Kehadiran</a></td>
                            <td><a href="{{ route('laporan.daftarpeserta', $p->id) }}" class="btn btn-success btn-sm">Lihat Evaluasi</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bolder">Selesai</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pelatihan</th>
                            <th>Jadwal</th>
                            <th>Lihat Kehadiran</th>
                            <th>Lihat Evaluasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periode[$keype]['periodeselesai'] as $p)
                        <tr>
                            <td>{{ $p->namapelatihan }}</td>
                            <td>{{ $p->jadwal }}</td>
                            <td><a href="{{ url('./lihat_absensi/'. $p->id. '/'. $p->idpeserta) }}" class="btn btn-success btn-sm">Lihat Kehadiran</a></td>
                            <td><a href="{{ route('laporan.daftarpeserta', $p->id) }}" class="btn btn-success btn-sm">Lihat Evaluasi</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<hr class="hr" />
@endif
@endforeach
@endif
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#pelatihan').DataTable({
            "scrollX": true
        });
    });
    function buka_absensi(idperiode, jumlah_pertemuan) {
        $("#modal-buka-absen").modal("show");
        $("#buka-absen-nomor-pertemuan").html("<input type='number' name='nomor_pertemuan' max="+jumlah_pertemuan+" min=0' required placeholder='Nomor pertemuan'>");
        $("#buka-absen-id-periode").html("<input type='hidden' name='idperiode' value='"+idperiode+"' required > ");
    }
</script>
@endsection
