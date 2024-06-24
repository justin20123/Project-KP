<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user());
        // $nomor_peserta = (Auth::user());
        // dd(Auth::user());
        $pelatihans = DB::table('pelatihan')
            ->select('pelatihan.*')
            ->join("kelas_diikuti","kelas_diikuti.idpelatihan","=","pelatihan.id")
            ->where("kelas_diikuti.id_peserta","=", Auth::id())
            ->get();

        return view('pelatihan.index', ["list_pelatihan"=>$pelatihans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelatihan  $pelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelatihan $pelatihan)
    {
        //
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

    public function lihat_absensi(Request $request, string $role, string $nomor_peserta=null, int $idpelatihan)
    {
        if($role == "peserta"){
            $pelatihans = DB::table('absensi')
            ->select('absensi.*')
            ->where("absensi.nomor_peserta","=",$nomor_peserta)
            ->where("absensi.idpelatihan","=",$idpelatihan)
            ->get();     
        }
        else{
            $pelatihans = DB::table('absensi')
            ->select('absensi.*')
            ->where("absensi.idpelatihan","=",$idpelatihan)
            ->get();
        }
        return view('absensi.index', compact('list_absensi'));
    }
}
