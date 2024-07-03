<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajar = DB::table('users')
            ->select('users.*')
            ->where('role', 'pengajar')
            ->get();
    
        return view('pengajar.index', compact('pengajar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengajar.create');
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
        $user = new Users();
        $user->password = Hash::make($request->get('password'));
        
        $user->nama = $request->get('nama');
        $user->alamat = $request->get('alamat');
        $user->email = $request->get('email');
        $user->umur = $request->get('umur');
        $user->role = "pengajar";
        $user->status = "1";
        $user->created_at = now("Asia/Bangkok");
        $user->updated_at = now("Asia/Bangkok");
        $user->save();


        return redirect()->route('pengajar.index')->with('status', 'New pengajar  ' .  $user->nama . ' is already inserted');
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
        $user = Users::where('id', $id)->first();
        return view('pengajar.edit', compact('user'));       
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
        $user->created_at = now("Asia/Bangkok");
        $user->updated_at = now("Asia/Bangkok");
        $user->save();

        return redirect()->route('pengajar.index')->with('status', 'pengajar '  .  $user->nama . ' is already updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajar $pengajar)
    {
       
    }   
}
