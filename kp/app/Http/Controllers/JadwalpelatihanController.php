<?php

namespace App\Http\Controllers;

use App\Models\Jadwalpelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalpelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $jadwal_pelatihan = DB::table('jadwal_pelatihan')
            ->join('pelatihan','jadwal_pelatihan.idpelatihan', '=' , 'pelatihan.id')
            ->join('users','jadwal_pelatihan.id_pengajar', '=' , 'users.id')
            ->select('jadwal_pelatihan.*', 'pelatihan.nama as namapelatihan', 'pelatihan.jumlah_pertemuan as jumlahpertemuan', 'users.nama as namapengajar')
            ->where('jadwal_pelatihan.status','=','berjalan')
            ->get();
            return view('jadwalpelatihan.index', ["jadwalpelatihan" => $jadwal_pelatihan]);
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
        return view('jadwalpelatihan.create', ['pengajar'=>$pengajar,'pelatihan'=>$pelatihan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwal_pelatihan = new Jadwalpelatihan();
        $jadwal_pelatihan->tanggal_start = $request->get('tanggal_start');
        $jadwal_pelatihan->jenis_pelatihan = $request->get('jenis_pelatihan');
        $jadwal_pelatihan->status = "berjalan";
        $jadwal_pelatihan->jadwal = $request->get('hari_pertemuan').','.$request->get('waktu_awal_pertemuan').'-'.$request->get('waktu_akhir_pertemuan');

        $jadwal_pelatihan->created_at = now("Asia/Bangkok");
        $jadwal_pelatihan->updated_at = now("Asia/Bangkok");

        $jadwal_pelatihan->id_pengajar = $request->get('id_pengajar'); 
        $jadwal_pelatihan->idpelatihan = $request->get('idpelatihan'); 
        $jadwal_pelatihan->save();
        return redirect()->route('jadwalpelatihan.index')->with('message', 'Jadwal pelatihan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwalpelatihan  $jadwalpelatihan
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwalpelatihan $jadwalpelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwalpelatihan  $jadwalpelatihan
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
        $jadwalpelatihan = Jadwalpelatihan::find($id);
        return view('jadwalpelatihan.edit', ['pengajar'=>$pengajar,'pelatihan'=>$pelatihan,'jadwalpelatihan'=>$jadwalpelatihan]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwalpelatihan  $jadwalpelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal_pelatihan = Jadwalpelatihan::find($id);
        $jadwal_pelatihan->tanggal_start = $request->get('tanggal_start');
        $jadwal_pelatihan->jenis_pelatihan = $request->get('jenis_pelatihan');
        $jadwal_pelatihan->status = "berjalan";
        $jadwal_pelatihan->jadwal = $request->get('hari_pertemuan').','.$request->get('waktu_awal_pertemuan').'-'.$request->get('waktu_akhir_pertemuan');

        $jadwal_pelatihan->updated_at = now("Asia/Bangkok");

        $jadwal_pelatihan->save();
        return redirect()->route('jadwalpelatihan.index')->with('status', 'Pelatihan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwalpelatihan  $jadwalpelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwalpelatihan $jadwalpelatihan)
    {
        //
    }
}
