<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminAktif = DB::table('users')
            ->select('users.*')
            ->where('role','=','admin')
            ->where('status', '=', '1')
            ->get();
        $adminNonaktif = DB::table('users')
            ->select('users.*')
            ->where('role','=','admin')
            ->where('status', '=', '0')
            ->get();

        return view('admin.index', compact('adminAktif', 'adminNonaktif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
        $user->role = "Admin";
        $user->status = "1";
        $user->created_at = now("Asia/Bangkok");
        $user->updated_at = now("Asia/Bangkok");
        $user->save();

        return redirect()->route('admin.index')->with('status', 'New Admin  ' .  $user->nama . ' is already inserted');
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
        return view('admin.edit', compact('user'));
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

        return redirect()->route('admin.index')->with('status', 'Admin ' .  $user->nama . ' is already updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nonaktifkan(Request $request)
    {
        $admin = Users::where('users_id', $request->get('id'))->first();
        $admin->status = '0';
        $admin->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function aktifkan(Request $request)
    {
        $admin = Users::where('users_id', $request->get('id'))->first();
        $admin->status = '1';
        $admin->save();
        return response()->json(array('status' => 'success'), 200);
    }

    public function ubahPassword()
    {
        return view('ubahpassword');
    }
    public function newPassword(Request $request)
    {
        if ((Hash::check($request->oldPassword, auth()->user()->password)) == false) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:8',
            'KonfNewPassword' => ['same:newPassword'],
        ], [
            'newPassword.required' => 'Password harus diisi.',
            'KonfNewPassword.required' => 'Confirm Password harus diisi.',

            'newPassword.min' => 'Password minimal harus terdiri dari 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            Users::find(auth()->user()->id)->update(['password' => Hash::make($request->newPassword)]);
            return redirect('/');
        }
    }
}
