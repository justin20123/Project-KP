<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalKelasController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Request::all();
        return view('jadwalkelas.create', ["jadwalkelas" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curr_date = Carbon::now()->locale('id')->toDateString(); 

        $jadwal_kelas = new JadwalKelas();
        $jadwal_kelas->jenis_pertemuan = $request->post("jenis_pertemuan");
        $jadwal_kelas->idperiode = $request->post("idperiode");
        $jadwal_kelas->nomor_pertemuan = $request->post("nomor_pertemuan");

        $cek_tanggal = DB::table('jadwal_kelas')
            ->select('*')
            ->where("idperiode", "=", $jadwal_kelas->idperiode)
            ->where("tanggal_absensi", "=", $curr_date)
            ->get();


        if ($cek_tanggal->count() == 0) { //kalau hari ini belum buka presensi
            $pengikut_kelas = DB::table('laporan')
            ->select("*")
            ->where("idperiode","=",$jadwal_kelas->idperiode)
            ->get();
                $jadwal = new JadwalKelas();
                $jadwal->nomor_pertemuan = $jadwal_kelas->nomor_pertemuan;
                $jadwal->jenis_pertemuan = $jadwal_kelas->jenis_pertemuan;
                $jadwal->tanggal_absensi = $curr_date;
                $jadwal->idperiode = $jadwal_kelas->idperiode;
                $jadwal->save();
                $idjadwal = $jadwal->id;
            foreach ($pengikut_kelas as $pengikut) {
                $absensi = new Absensi();
                $absensi->status_kehadiran = "alfa";
                $absensi->idjadwalkelas = $idjadwal;
                $absensi->id_peserta = $pengikut->id_peserta;
                $absensi->save();
            }
            $message = "Absensi berhasil dibuka";
            return redirect()->route("periode.index")->with("message", $message);
        }
        else{
            return redirect()->route("periode.index")->with("error","Anda sudah membuka presensi hari ini");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalKelas  $jadwal_kelas
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalKelas $jadwal_kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalKelas  $jadwal_kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalKelas $jadwal_kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JadwalKelas  $jadwal_kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalKelas $jadwal_kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalKelas  $jadwal_kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalKelas $jadwal_kelas)
    {
        //
    }
}
