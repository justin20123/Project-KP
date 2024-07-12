<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_orangtua = null)
    {
        if($id_orangtua == null){
            $peserta = DB::table('peserta')
            ->join('users', 'users.id','=','peserta.id_orangtua')
            ->select('peserta.*', 'users.nama as namaorangtua')
            ->get();
        }else{
            $peserta = DB::table('peserta')
            ->join('users', 'id','=','id_orangtua')
            ->select('peserta.*', 'users.nama as namaorangtua')
            ->where('users.id', '=', $id_orangtua)
            ->get();
        }
        return view('peserta.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orangtua = DB::table('users')
        ->select("*")
        ->where('role','=','orang_tua')
        ->get();
        return view('peserta.create',compact('orangtua'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $peserta = new Peserta();
        $peserta->nama = $request->get('nama');
        $peserta->umur = $request->get('umur');

        $peserta->created_at = now("Asia/Bangkok");
        $peserta->updated_at = now("Asia/Bangkok");

        $peserta->id_orangtua = $request->get('id_orangtua');
        $peserta->save();

        return redirect()->route('peserta.index')->with('message', 'Peserta ' .  $peserta->nama . ' berhasil ditambahkan');
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
            $orangtua = Users::where('nama', $row[2])->first(); // assuming id_orangtua is in column 4
            if ($orangtua) {
                $idortu = $orangtua->id;
            } else {
                return redirect()->back()->with('error', 'Orang tua tidak ditemukan'); 
            }
            Peserta::create([
                'nama' => $row[0],
                'umur' => $row[1],
                'id_orangtua' => $idortu,
            ]);
        }
        File::delete(public_path('uploads/' . $filename));
        return redirect()->back()->with('status', 'CSV file uploaded successfully!');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $orangtua = DB::table('users')
        ->select("*")
        ->where('role','=','orang_tua')
        ->get();
        $peserta = Peserta::find($id);
        return view('peserta.edit', compact('peserta', 'orangtua'));       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $peserta = Peserta::find($id); 

        $peserta->nama = $request->get('nama');
        $peserta->umur = $request->get('umur');
        $peserta->id_orangtua = $request->get('id_orangtua');
        $peserta->updated_at = now("Asia/Bangkok");
        $peserta->save();

        return redirect()->route('peserta.index')->with('message', 'Peserta '  .  $peserta->nama . ' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $sisw)
    {
       
    }
}
