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
        
        $orangtua = DB::table('users')
        ->select('*')
        ->where('role','=','orang_tua')
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
        return view('orangtua.create');
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

        $users = new Users();
        $users->nama = $request->get('nama');
        $users->alamat = $request->get('alamat');
        $users->email = $request->get('email');
        $users->password = $request->get('password');
        $users->role = "orang_tua";
        $users->status = 1;
        $users->created_at = now("Asia/Bangkok");
        $users->updated_at = now("Asia/Bangkok");
        $users->save();

        return redirect()->route('orangtua.index')->with('status', 'Orangtua  ' .  $users->nama . ' berhasil ditambahkan');
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
        $orangtua = Users::where('id', $id)->first();
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
        $users = Users::where('id', $id)->first();

        $users->nama = $request->get('nama');
        $users->alamat = $request->get('alamat');
        $users->save();

        return redirect()->route('orangtua.index')->with('status', 'Orangtua '  .  $users->nama . ' berhaso; diupdate');
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
