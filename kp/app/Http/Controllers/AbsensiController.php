<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Kelas_diikuti;
use App\Models\Pelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        
        $curr_date = Carbon::now()->locale('id')->toDateString(); 

        $absensi = new Absensi();
        $absensi->jenis_pertemuan = $request->post("jenis_pertemuan");
        $absensi->idjadwalpelatihan = $request->post("idjadwalpelatihan");
        $absensi->nomor_pertemuan = $request->post("nomor_pertemuan");

        $cek_tanggal = DB::table('absensi')
            ->select('absensi.*')
            ->where("absensi.idjadwalpelatihan", "=", $absensi->idjadwalpelatihan)
            ->where("absensi.tanggal_absensi", "=", $curr_date)
            ->get();


        if ($cek_tanggal->count() == 0) { //kalau hari ini belum buka presensi
            $pengikut_kelas = DB::table('kelas_diikuti')
            ->select("*")
            ->where("idjadwalpelatihan","=",$absensi->idjadwalpelatihan)
            ->get();
            foreach ($pengikut_kelas as $pengikut) {
                $absen = new Absensi();
                $absen->nomor_pertemuan = $absensi->nomor_pertemuan;
                $absen->status = "dibuka";
                $absen->jenis_pertemuan = $absensi->jenis_pertemuan;
                $absen->tanggal_absensi = $curr_date;
                $absen->status_kehadiran = "alfa";
                $absen->idjadwalpelatihan = $pengikut->idjadwalpelatihan;
                $absen->id_peserta = $pengikut->id_peserta;
                $absen->save();
            }
            $message = "Absensi berhasil dibuka";
            return redirect()->route("jadwalpelatihan.index")->with("message", $message);
        }
        else{
            return redirect()->route("jadwalpelatihan.index")->with("error","Anda sudah membuka presensi hari ini");
        }
    }

    public function doAbsensi(Request $request){
        
        $cek_tersedia = DB::table('absensi')
        ->select('absensi.*')
        ->where('idjadwalpelatihan','=',$request->idabsensi)
        ->get();

   
        if($cek_tersedia->count() == 0){
            return redirect()->route("pelatihan.index")->with("error","Absensi tidak ditemukan");
        }
        else{
            $kehadiran = Kehadiran::where("id",$request->idabsensi)->first();
            $kehadiran->status = "hadir";
            $kehadiran->sudah_absen = 1;
            $kehadiran->save();
            return redirect()->route("pelatihan.index")->with("message", "Absensi berhasil");
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
