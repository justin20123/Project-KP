<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
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
        if (Auth::user()->role == "admin") {
            $pelatihan = DB::table('pelatihan')
                ->select('pelatihan.*')
                ->join('users','users.id','=','pelatihan.id_pengajar')
                ->get();
        }
        else if (Auth::user()->role == "pengajar") {
            $pelatihan = DB::table('pelatihan')
                ->select('pelatihan.*')
                ->where("id_pengajar", "=", Auth::id())
                ->get();
        } else if (Auth::user()->role == "peserta") {
            $pelatihan = DB::table('pelatihan')
                
                ->join("kelas_diikuti", "kelas_diikuti.idpelatihan", "=", "pelatihan.id")
                ->select('pelatihan.*')
                ->where("kelas_diikuti.id_peserta", "=", Auth::id())
                ->get();
        }


        return view('pelatihan.index', ["pelatihan" => $pelatihan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelatihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelatihan = new Pelatihan();
        $pelatihan->nama = $request->get('pelatihan');
        $pelatihan->deskripsi = $request->get('deskripsi');
        $pelatihan->jadwal_pertemuan = $request->get('jadwal_pertemuan');
        $pelatihan->nomor_angkatan = 1; //pelatihan baru

        $pelatihan->created_at = now("Asia/Bangkok");
        $pelatihan->updated_at = now("Asia/Bangkok");

        $pelatihan->save();
        return redirect()->route('pelatihan.index')->with('status', 'New pelatihan ' .  $pelatihan->nama . ' is already inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelatihan  $pelatihan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelatihan  $pelatihan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelatihan = Pelatihan::find($id);
        return view('pelatihan.edit', compact('pelatihan'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelatihan  $pelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $pelatihan = Pelatihan::find($id);
        $pelatihan->nama = $request->get('pelatihan');
        $pelatihan->deskripsi = $request->get('deskripsi');
        $pelatihan->jadwal_pertemuan = $request->get('jadwal_pertemuan');

        $pelatihan->updated_at = now("Asia/Bangkok");

        $pelatihan->save();
        return redirect()->route('pelatihan.index')->with('status', 'Pelatihan '  .  $pelatihan->nama . ' is already updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelatihan  $pelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelatihan $pelatihan)
    {
        //
    }

    public function lihat_absensi(Request $request, string $role, string $nomor_peserta = null, int $idpelatihan)
    {
        if ($role == "peserta") {
            $pelatihans = DB::table('absensi')
                ->select('absensi.*')
                ->where("absensi.nomor_peserta", "=", $nomor_peserta)
                ->where("absensi.idpelatihan", "=", $idpelatihan)
                ->get();
        } else if ($role == "pengajar"){
            $pelatihans = DB::table('absensi')
                ->select('absensi.*')
                ->where("absensi.idpelatihan", "=", $idpelatihan)
                ->get();
        }
        return view('absensi.index', compact('list_absensi'));
    }

    
}
