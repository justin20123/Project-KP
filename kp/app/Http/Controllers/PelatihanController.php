<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                ->select('*')
                ->get();
        }
        else if (Auth::user()->role == "pengajar") {
            $pelatihan = DB::table('pelatihan')
                ->select('pelatihan.*')
                ->where("id_pengajar", "=", Auth::id())
                ->get();
        } else if (Auth::user()->role == "orang_tua") {
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
        $pelatihan->nama = $request->get('nama');
        $pelatihan->deskripsi = $request->get('deskripsi');
        $pelatihan->jumlah_pertemuan = $request->get('jumlah_pertemuan');

        $pelatihan->created_at = now("Asia/Bangkok");
        $pelatihan->updated_at = now("Asia/Bangkok");

        $pelatihan->save();
        return redirect()->route('pelatihan.index')->with('status', 'Pelatihan ' .  $pelatihan->nama . ' berhasil ditambahkan');
    }

    public function uploadcsv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('csv_file');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
    
        $csvData = array();
        if (($handle = fopen(public_path('uploads/' . $filename), 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csvData[] = $data;
            }
            fclose($handle);
        }
    
        foreach ($csvData as $row) {
            Pelatihan::create([
                'nama' => $row[0],
                'deskripsi' => $row[1],
                'jumlah_pertemuan' => $row[2],
            ]);
        }
    
        return redirect()->back()->with('status', 'CSV file uploaded successfully!');   
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
        $pelatihan->nama = $request->get('nama');
        $pelatihan->deskripsi = $request->get('deskripsi');
        $pelatihan->jumlah_pertemuan = $request->get('jumlah_pertemuan');

        $pelatihan->updated_at = now("Asia/Bangkok");

        $pelatihan->save();
        return redirect()->route('pelatihan.index')->with('status', 'Pelatihan '  .  $pelatihan->nama . ' berhasil diupdate');
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
