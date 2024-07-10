<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalKelas;
use App\Models\Kehadiran;
use App\Models\Kelas_diikuti;
use App\Models\Pelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function lihat_absensi($id){
        if(Auth::user()->role == 'pengajar'){
            $peserta = DB::table('absensi')
            ->join('jadwal_kelas','jadwal_kelas.id','=','absensi.idjadwalkelas')
            ->join('periode','jadwal_kelas.idperiode','=','periode.id')
            ->join('pelatihan','pelatihan.id','=','periode.idpelatihan')
            ->join('peserta','absensi.id_peserta','=','peserta.id')
            ->select('absensi.*', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta', 'peserta.id as idpeserta')
            ->where('periode.id','=',$id)
            ->get();
            $jadwalkelas = DB::table('jadwal_kelas')
            ->select('jadwal_kelas.*')
            ->where('idperiode','=',$id)
            ->get();
            return view ('absensi.index',["peserta"=>$peserta,'jadwalkelas'=>$jadwalkelas]);  
        }
        elseif(Auth::user()->role == 'orang_tua'){
            $peserta = DB::table('absensi')
            ->join('jadwal_kelas','jadwal_kelas.id','=','absensi.idjadwalkelas')
            ->join('periode','jadwal_kelas.idperiode','=','periode.id')
            ->join('pelatihan','pelatihan.id','=','periode.idpelatihan')
            ->join('peserta','absensi.id_peserta','=','peserta.id')
            ->select('absensi.*', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta', 'peserta.id as idpeserta', 'jadwal_kelas.nomor_pertemuan as nomorpertemuan')
            ->where('idperiode','=',$id)
            ->get();
            return view ('absensi.index',["peserta"=>$peserta]);  
        }
    }

    public function edit_absensi($id){
        if(Auth::user()->role == 'pengajar'){
            $peserta = DB::table('absensi')
            ->join('jadwal_kelas','jadwal_kelas.id','=','absensi.idjadwalkelas')
            ->join('periode','jadwal_kelas.idperiode','=','periode.id')
            ->join('pelatihan','pelatihan.id','=','periode.idpelatihan')
            ->join('peserta','absensi.id_peserta','=','peserta.id')
            ->select('absensi.*', 'jadwal_kelas.nomor_pertemuan as nomor_pertemuan', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta', 'peserta.id as idpeserta','absensi.status_kehadiran as statushadir')
            ->where('jadwal_kelas.id','=',$id)
            ->get();

            return view ('absensi.edit',["peserta"=>$peserta,'opsi_hadir'=>['hadir','alfa','ijin','sakit']]);       
        }
    }

    public function updatestatuskehadiran(Request $request)
{
    $peserta = $request->peserta; 

    foreach ($peserta as $p) {
        $idpeserta = $p['idpeserta'];
        $status_kehadiran = $p['status_kehadiran'];

    
        DB::table('absensi')
            ->where('id_peserta', $idpeserta)
            ->where('idjadwalkelas', $request->get('idjadwalkelas'))
            ->update(['status_kehadiran' => $status_kehadiran]);
    }

    // return a success response
    return redirect()->back()->with('status', 'Status kehadiran berhasil diperbarui.');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Request::all();
        return view('absensi.create', ["absensi" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bukaAbsensiForm(Pelatihan $pelatihan){
        return view("modals/buka_absensi", ["pelatihan" => $pelatihan]);
    }

    public function store(Request $request)
    {
        
    }

    public function hadirsemua(Request $request){
        $idjadwalkelas = $request->get('idjadwalkelas');
        Absensi::where('idjadwalkelas', $idjadwalkelas)
        ->update(['status_kehadiran' => 'hadir']);
        
        $message = "Absensi berhasil diupdate";
        return redirect()->route('absensi.lihat_absensi', $request->get('idperiode'));
    }   


    public function alfasemua(Request $request){
        $idjadwalkelas = $request->get('idjadwalkelas');
        Absensi::where('idjadwalkelas', $idjadwalkelas)
        ->update(['status_kehadiran' => 'alfa']);
        
        $message = "Absensi berhasil diupdate";
        return redirect()->route('absensi.lihat_absensi', $request->get('idperiode'));
    }

    public function doAbsensi(Request $request){
        foreach($request->absen as $absen){

        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
    
}
