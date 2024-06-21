<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_pesertas = DB::table('users')
            ->select('users.*')
            ->where('role',"=","peserta")
            ->whereNull('pesertas.deleted_at')
            ->get();

        $softDeletedPesertas = Peserta::onlyTrashed()
        ->with(['user' => function ($query) {
            $query->withTrashed();}])
        ->get();

        return view('peserta.index', [
            'user_pesertas' => $user_pesertas,
            'deleted_pesertas' =>$softDeletedPesertas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Display add new peserta form
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
        //
        $peserta = DB::table('users')
        ->select('users.*')
        ->where('peserta.nomor', '=', $id)
        ->get();

        return view('peserta.edit', [
            'peserta' => $peserta
        ]);
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

        $peserta = Peserta::with('user')->findOrFail($id);

        // Check if the $peserta or $peserta->user is null
        if (!$peserta || !$peserta->user) {
            return redirect()->route('admin.peserta.index')->with('success', 'Data User & Peserta Tidak Valid!');
        }

        $validatedData = $request->validate([
            'username' => 'required|max:16',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:45',
            'address' => 'required|max:255'
        ]);

        if (
            $peserta->phone == $validatedData['phone'] &&
            $peserta->address == $validatedData['address'] &&
            $peserta->user->username == $validatedData['username'] &&
            $peserta->user->email == $validatedData['email']
        ) {
            return redirect()->route('admin.peserta.edit', ['peserta' => $id])->with('msg', 'Tidak Ada Perubahan Data!');
        } else {
            $peserta->phone = $validatedData['phone'];
            $peserta->address = $validatedData['address'];

            // Update the user attributes
            $peserta->user->username = $validatedData['username'];
            $peserta->user->email = $validatedData['email'];
            $peserta->user->save();

            $peserta->save();

            return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta berhasil diperbaharui!');
        }

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
        // Find the peserta by ID
        $peserta = Peserta::findOrFail($id);

        // Delete the peserta and the related users
        $peserta->delete();
        
        return redirect()->back()->with('success', 'Peserta berhasil dihapus.');
    }

    public function restore($id)
    {
        $peserta = Peserta::onlyTrashed()->findOrFail($id);

        $peserta->restore();

        return redirect()->back()->with('success', 'Peserta berhasil dikembalikan.');
        // return redirect()->back()->with('success', 'Peserta gagal dikembalikan.');
    }

    //mendaftarkan/store akun dengan role peserta ke table user
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:45',
            'username' => 'required|max:16',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'buyer'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // dd($validatedData);
        $user = User::create($validatedData);

        //update role
        $changeToPeserta = User::where('email', $validatedData['email'])->first();
        $changeToPeserta->role = 'peserta';
        $changeToPeserta->save();

        $latestID = $user->id;
        // dd($validatedData);
        return redirect()->route('owner.peserta.activate', ['id' => $latestID])
        ->with('success', 'Lengkapi Data Diri Peserta Berikut !');


    }

    //menampilkan form registrasi akun user
    public function formRegister(Request $request){
        return view('peserta.create');
    }

    //menampilkan form data diri akun peserta
    public function formActivate($id){

        return view('peserta.activate', [
            'id' => $id
        ]);
    }

    //mendaftarkan/store akun dengan role peserta ke table peserta
    public function verifiedAccount(Request $request){

        $validatedData = $request->validate([
            'phone' => 'required|max:16',
            'address' => 'required|max:255',
            'gender' => 'required',
            'hired' => 'required',
            'birthdate' => 'required',
        ]);

        $validatedData['user_id'] = User::latest()->value('id');

        // dd($validatedData);
        Peserta::create($validatedData);
        return redirect()->route('admin.peserta.index')
        ->with('success', 'Berhasil Menambahkan Akun Peserta Baru!');
    }

}
