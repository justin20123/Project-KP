<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       if(Auth::user()->role == 'pengajar'){
        
       }
    }

    public function daftarpeserta($idperiode)
    {
        if (Auth::user()->role == "admin") {
            $anggota_kelas = DB::table('laporan')
                ->join('periode', 'laporan.idperiode', '=', 'periode.id')
                ->join('peserta', 'laporan.id_peserta', '=', 'peserta.id')
                ->join('pelatihan', 'periode.idpelatihan', '=', 'pelatihan.id')
                ->select('laporan.*', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta')
                ->where('periode.id','=',$idperiode)
                ->get();

                //dd($anggota_kelas);
                
                $peserta = DB::table("peserta")
                ->whereNotIn('id', function($query) use ($idperiode) {
                    $query->select('id_peserta')
                          ->from('laporan')
                          ->where('idperiode', $idperiode);
                })
                ->select('id as idpeserta', 'nama as namapeserta')
                ->get();
            return view('laporan.index', ['anggota_kelas'=>$anggota_kelas, 'peserta'=>$peserta]);
        }
        else if (Auth::user()->role == "pengajar") {
            $anggota_kelas = DB::table('laporan')
                ->join('periode', 'laporan.idperiode', '=', 'periode.id')
                ->join('peserta', 'laporan.id_peserta', '=', 'peserta.id')
                ->join('pelatihan', 'periode.idpelatihan', '=', 'pelatihan.id')
                ->select('laporan.*', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta', 'peserta.id as idpeserta')
                ->where('periode.id','=',$idperiode)
                ->get();
            return view('laporan.index', ['anggota_kelas'=>$anggota_kelas]);
        }else if (Auth::user()->role == "orang_tua") {
            $evaluasi = DB::table('laporan')
                ->join('periode', 'laporan.idperiode', '=', 'periode.id')
                ->join('peserta', 'laporan.id_peserta', '=', 'peserta.id')
                ->join('pelatihan', 'periode.idpelatihan', '=', 'pelatihan.id')
                ->select('laporan.*', 'pelatihan.nama as namapelatihan', 'periode.kelas_paralel as kelasparalel','periode.id as idperiode', 'peserta.nama as namapeserta', 'peserta.id as idpeserta', 'laporan.evaluasi as eval')
                ->where('periode.id','=',$idperiode)
                ->where('peserta.id_orangtua','=',Auth::id())
                ->get();
            return view('laporan.index', ['evaluasi'=>$evaluasi]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $laporan = new Laporan();
        // $laporan->id_peserta = $request->get('id_peserta');
        // $laporan->idperiode = $request->get('idperiode');
        // $laporan->evaluasi = '';
        DB::statement("INSERT INTO laporan (id_peserta, idperiode, evaluasi) VALUES (?,?,?)", [$request->get('id_peserta'), $request->get('idperiode'), '']);
        return redirect()->route('laporan.daftarpeserta', [ 'id'=>$request->get('idperiode'), 'message' => 'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    public function isievaluasi($idperiode, $id_peserta){
        $periode = DB::table('periode')
        ->join('pelatihan','periode.idpelatihan','=','pelatihan.id')
        ->select('periode.kelas_paralel as kelasparalel', 'pelatihan.nama as namapelatihan', 'periode.id as idperiode')
        ->where('periode.id','=',$idperiode)
        ->first();
        
        $peserta = DB::table('peserta')
        ->select('*')
        ->where('id','=',$id_peserta)
        ->first();
   
        $laporan = DB::table('laporan')
        ->where('idperiode', $idperiode)
        ->where('id_peserta','=',$id_peserta)->first();

        return view('laporan.edit', ['periode'=>$periode, 'peserta'=>$peserta, 'laporan'=>$laporan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {

    }

    public function updateevaluasi(Request $request)
    {
        $new_evaluasi = $request->get('evaluasi');
        $id_peserta = $request->get('idpeserta');
        $idperiode = $request->get('idperiode');
    
        DB::statement("UPDATE laporan SET evaluasi = ? WHERE id_peserta = ? AND idperiode = ?", [$new_evaluasi, $id_peserta, $idperiode]);
        return redirect()->route('laporan.daftarpeserta',$idperiode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
