<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use App\Models\Peserta;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OrangtuaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $orangtua = DB::table('orang_tua')
        ->join('users','users.id' , '=', 'orang_tua.id_peserta')
        ->select('orang_tua.nama as namaorangtua', 'orang_tua.email as emailorangtua', 'orang_tua.id as idorangtua', 'users.nama as namapeserta')
        
        ->get();
    
        return view('orangtua.index', compact('orangtua'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peserta = DB::table('users')
        ->where('role', '=', 'peserta')
        ->get();
        return view('orangtua.create', compact('peserta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ], [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $orangtua = new Orangtua();
        $orangtua->id_peserta = $request->get('peserta');
        $orangtua->nama = $request->get('nama');
        $orangtua->email = $request->get('email');
        $orangtua->password = $request->get('password');
        $orangtua->created_at = now("Asia/Bangkok");
        $orangtua->updated_at = now("Asia/Bangkok");
        $orangtua->save();

        return redirect()->route('orangtua.index')->with('status', 'New orangtua  ' .  $orangtua->nama . ' is already inserted');
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
        $orangtua = Orangtua::where('id', $id)->first();
        return view('orangtua.edit', compact('orangtua'));       
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
        $orangtua = Orangtua::where('id', $id)->first();

        $orangtua->nama = $request->get('nama');
        $orangtua->updated_at = now("Asia/Bangkok");
        $orangtua->save();

        $orangtua->nama = $request->get('nama');
        $orangtua->updated_at = now("Asia/Bangkok");
        $orangtua->save();

        return redirect()->route('orangtua.index')->with('status', 'orangtua '  .  $orangtua->nama . ' is already updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orangtua $orangtua)
    {
       
    }
}
