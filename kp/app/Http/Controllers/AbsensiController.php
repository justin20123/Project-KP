<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $absensi = new Absensi();
        $absensi->nomor_angkatan = $request->post("nomor_angkatan");
        $absensi->status = $request->post("status");
        $absensi->tanggal_absensi = $request->post("tanggal_absensi");
        $absensi->id_pelatihan = $request->post("id_pelatihan");

        $cek_tanggal = DB::table('absensi')
            ->select('absensi.*')
            ->where("absensi.idpelatihan", "=", $data["idpelatihan"])
            ->where("absensi.tanggal_absensi", "=", $data["tanggal_absensi"])
            ->get();


        if ($cek_tanggal->tanggal_absensi != Carbon::date("Y-m-d")->toDateString()) { //kalau hari ini belum buka presensi
            $pertemuan_sekarang = "";
            $pertemuan_sebelumnya = DB::table('absensi')
                ->select('absensi.max("nomor_pertemuan")')
                ->where("absensi.idpelatihan", "=", $data["idpelatihan"])
                ->where("absensi.nomor_angkatan", "=", $data["nomor_angkatan"])
                ->get();
            if ($pertemuan_sebelumnya->count == 0) {
                $pertemuan_sekarang = 1;
            }
            else{
                $pertemuan_sekarang = $pertemuan_sebelumnya->nomor_pertemuan + 1;
            }
            return Pelatihan::create([
                'nomor_angkatan' => $data["nomor_angkatan"],
                'nomor_pertemuan' => $pertemuan_sekarang,
                'status' => "dibuka",
                'jenis_pertemuan' => $data['jenis_pertemuan'],
                'tanggal_absensi' => Carbon::date("Y-m-d")->toDateString(),
                'idpelatihan' => $data['idpelatihan'],
            ]);
        }
    }

    public function bukaAbsensi(){

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
