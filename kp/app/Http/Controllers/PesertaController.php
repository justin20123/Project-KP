<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peserta = DB::table('users')
        ->select('users.*', 'orang_tua.nama as namaorangtua')
        ->join('orang_tua', 'users.id', '=', 'orang_tua.id_peserta')
        ->get();
        return view('peserta.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peserta.create');
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
        $users->umur = $request->get('umur');
        $users->password = Hash::make($request->get('password'));
        $users->role = "Peserta";
        $users->status = 1;
        $users->last_login = now("Asia/Bangkok");
        $users->created_at = now("Asia/Bangkok");
        $users->updated_at = now("Asia/Bangkok");
        $users->save();

        return redirect()->route('peserta.index')->with('status', 'New peserta  ' .  $users->nama . ' is already inserted');
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
        $user = Users::find($id);
        return view('peserta.edit', compact('user'));       
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
        $user = Users::find($id); 

        $user->nama = $request->get('nama');
        $user->alamat = $request->get('alamat');
        $user->umur = $request->get('umur');
        $user->updated_at = now("Asia/Bangkok");
        $user->save();

        return redirect()->route('peserta.index')->with('status', 'peserta '  .  $user->nama . ' is already updated');
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
