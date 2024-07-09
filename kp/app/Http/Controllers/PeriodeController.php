<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
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
        if(Auth::user()->role == 'admin'){
            $periode = DB::table('periode')
            ->join('pelatihan','periode.idpelatihan', '=' , 'pelatihan.id')
            ->join('users','periode.id_pengajar', '=' , 'users.id')
            ->select('periode.*', 'pelatihan.nama as namapelatihan', 'pelatihan.jumlah_pertemuan as jumlahpertemuan', 'users.nama as namapengajar')
            ->where('periode.status','=','berjalan')
            ->get();
            return view('periode.index', ["periode" => $periode]);
        }
        elseif(Auth::user()->role == 'pengajar'){
            $periode = DB::table('periode')
            ->join('pelatihan','periode.idpelatihan', '=' , 'pelatihan.id')
            ->join('users','periode.id_pengajar', '=' , 'users.id')
            ->select('periode.*', 'pelatihan.nama as namapelatihan', 'pelatihan.jumlah_pertemuan as jumlahpertemuan', 'users.nama as namapengajar')
            ->where('periode.status','=','berjalan')
            ->where('periode.id_pengajar','=',Auth::id())
            ->get();
            return view('periode.index', ["periode" => $periode]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengajar = DB::table("users")
        ->select('*')
        ->where('role','=','pengajar')
        ->get();
        $pelatihan = DB::table("pelatihan")
        ->select('*')
        ->get();
        return view('periode.create', ['pengajar'=>$pengajar,'pelatihan'=>$pelatihan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = new Periode();
        $periode->tanggal_start = $request->get('tanggal_start');
        $periode->jenis_pelatihan = $request->get('jenis_pelatihan');
        $periode->status = "berjalan";
        $periode->jadwal = $request->get('hari_pertemuan').','.$request->get('waktu_awal_pertemuan').'-'.$request->get('waktu_akhir_pertemuan');
        $periode->kelas_paralel = $request->get('kelas_paralel');

        $periode->created_at = now("Asia/Bangkok");
        $periode->updated_at = now("Asia/Bangkok");

        $periode->id_pengajar = $request->get('id_pengajar'); 
        $periode->idpelatihan = $request->get('idpelatihan'); 
        $periode->save();
        return redirect()->route('periode.index')->with('message', 'Periode berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $pengajar = DB::table("users")
        ->select('*')
        ->where('role','=','pengajar')
        ->get();
        $pelatihan = DB::table("pelatihan")
        ->select('*')
        ->get();
        $periode = Periode::find($id);
        return view('periode.edit', ['pengajar'=>$pengajar,'pelatihan'=>$pelatihan,'periode'=>$periode]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $periode = Periode::find($id);
        $periode->tanggal_start = $request->get('tanggal_start');
        $periode->jenis_pelatihan = $request->get('jenis_pelatihan');
        $periode->status = "berjalan";
        $periode->jadwal = $request->get('hari_pertemuan').','.$request->get('waktu_awal_pertemuan').'-'.$request->get('waktu_akhir_pertemuan');
        $periode->kelas_paralel = $request->get('kelas_paralel');

        $periode->updated_at = now("Asia/Bangkok");

        $periode->save();
        return redirect()->route('periode.index')->with('status', 'Periode berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        //
    }
}