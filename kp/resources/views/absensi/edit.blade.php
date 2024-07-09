@extends('layouts.sneat')

@section('menu')

@if(Auth::user() != null)
<div class="modal fade" id="modal-update-status-kehadiran" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Update</h5>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Anda akan mengubah data kehadiran peserta sesuai status kehadirannya masing-masing</h4>
                <form method='POST' action='{{ route('absensi.updatestatuskehadiran') }}'>
                    @csrf
                    @foreach ($peserta as $p)
                        <input type="hidden" name="peserta[{{ $p->idpeserta }}][idpeserta]" value="{{ $p->idpeserta }}">
                        <input type="hidden" name="peserta[{{ $p->idpeserta }}][idjadwalkelas]" value="{{ $p->idjadwalkelas }}">
                        <div id="jadwalhadir{{$p->idpeserta}}"></div>
                        <div id="idjadwalkelas"></div>
                        
                    @endforeach
                    <input type="submit" name="Submit" id="">
                </form>
            </div>
        </div>
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
@if (count($peserta) == 0)
<p>Tidak ada data absensi ditemukan</p>
@else
<div style="margin: 15px; font-size: 20px;">
    <strong>List Kehadiran {{ $peserta[0]->namapelatihan }} ({{ $peserta[0]->kelasparalel }})</strong>
    

</div>
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h4>Pertemuan ke {{ $peserta[0]->nomor_pertemuan }}</h4>
            <button onclick="updatestatuskehadiran({{ $peserta[0]->idjadwalkelas }})" class="btn btn-primary">Update</button>
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
                        <div style="display:none;">
                            <p id="idpeserta-{{ $loop->iteration }}" >{{$p->idpeserta}}</p>
                        </div>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->namapeserta }}</td>
                            <td>
                                    <select id="status_hadir_{{$p->idpeserta}}" required>
                                    @foreach($opsi_hadir as $o)
                                        @if($o == $p->statushadir)
                                            <option value="{{ $o }}" selected>{{ $o }}</option>
                                        @else
                                            <option value="{{ $o }}">{{ $o }}</option>
                                        @endif               
                                    @endforeach
                                </select>
                            </td>


                        </tr>
                        @endforeach
                    
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif
@else
<p>Tidak ada data absensi</p>

@endif
@endsection

@section('content')


@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#pengajar').DataTable({
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

    function updatestatuskehadiran(id) {
        $("#modal-update-status-kehadiran").modal("show");
        var idpeserta = [];
        for(var i=1; i<={{ array_key_last($peserta->toArray()) + 1 }}; i++){
            idpeserta.push($("#idpeserta-"+i).text());
        }
        for(var i=0; i<{{ array_key_last($peserta->toArray()) + 1 }}; i++){
            var statushadir = $("#status_hadir_"+idpeserta[i]).val();
            $('#jadwalhadir' + idpeserta[i]).html(
                '<input type="hidden" name="peserta['+idpeserta[i]+'][status_kehadiran]" value="'+ statushadir +'">'
            );
            $('#idjadwalkelas').html(
                '<input type="hidden" name="idjadwalkelas" value="'+ id +'">'
            );
        }
        
        
    }
</script>
@endsection
