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
        
        $curr_date = Carbon::now()->toDateString(); 

        $absensi = new Absensi();
        $absensi->nomor_angkatan = $request->post("nomor_angkatan");
        $absensi->jenis_pertemuan = $request->post("jenis_pertemuan");
        $absensi->id_pelatihan = $request->post("id_pelatihan");

        $cek_tanggal = DB::table('absensi')
            ->select('absensi.*')
            ->where("absensi.idpelatihan", "=", $absensi->id_pelatihan)
            ->where("absensi.tanggal_absensi", "=", $curr_date)
            ->get();


        if ($cek_tanggal->count() == 0) { //kalau hari ini belum buka presensi
            $pertemuan_sekarang = "";
            $pertemuan_sebelumnya = DB::table('absensi')
                ->select('absensi.nomor_pertemuan')
                ->where("absensi.idpelatihan", "=", $absensi->id_pelatihan)
                ->where("absensi.nomor_angkatan", "=", $absensi->nomor_angkatan)
                ->get()->first();
            if ($pertemuan_sebelumnya == null) {
                $pertemuan_sekarang = 1;
            }
            else{
                $pertemuan_sekarang = $pertemuan_sebelumnya->nomor_pertemuan + 1;
            }
            $data_absen = Absensi::create([
                'nomor_angkatan' => $absensi->nomor_angkatan,
                'nomor_pertemuan' => $pertemuan_sekarang,
                'status' => "dibuka",
                'jenis_pertemuan' => $absensi->jenis_pertemuan,
                'tanggal_absensi' => $curr_date,
                'idpelatihan' => $absensi->id_pelatihan,
            ]);
            //Absensi berhasil dibuka

            $pengikut_kelas = DB::table('kelas_diikuti')
            ->select("*")
            ->where("idpelatihan","=",$absensi->id_pelatihan)
            ->get();
            foreach ($pengikut_kelas as $pengikut) {
                Kehadiran::create([
                    'nomor_pertemuan' =>$pertemuan_sekarang,
                    'status'=> "alfa",
                    'sudah_absen' => 0,
                    'id_peserta' => $pengikut->id_peserta,
                    'absensi_idpelatihan' => $absensi->id_pelatihan,
                    'idabsensi'=>$data_absen->id
                ]);
            }
            //nambahin kehadiran yg nanti diedit waktu absen

            $nama_pelatihan = DB::table('pelatihan')
            ->select('nama')
            ->where('id','=',$absensi->id_pelatihan)
            ->get();
            $message = "Absensi " . $nama_pelatihan[0]->nama . " berhasil dibuka";
            return redirect()->route("pelatihan.index")->with("message", $message);
        }
        else{
            return redirect()->route("pelatihan.index")->with("error","Anda sudah membuka presensi hari ini");
        }
    }

    public function doAbsensi(Request $request){

        $cek_tersedia = DB::table('absensi')
        ->select('absensi.*')
        ->where('id'.'=',$request->id)
        ->get();
        if($cek_tersedia->count() == 0){
            return redirect()->route("pelatihan.index")->with("error","Absensi tidak ditemukan");
        }
        else{
            $kehadiran = Kehadiran::where("id",$request->id)->first();
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
