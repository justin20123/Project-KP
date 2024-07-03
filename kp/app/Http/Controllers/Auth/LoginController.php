<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        
        if ($user->hasRole('admin')) {
            return redirect()->route('pengajar.index');
        } elseif (($user->hasRole('peserta'))||($user->hasRole('pengajar'))) {
            return redirect()->route('pelatihan.index');
        } elseif ($user->hasRole('orang_tua')) {
            return redirect()->route('pelatihan.index');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            // User is authenticated
            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('pengajar') || Auth::user()->hasRole('peserta')) {
                // Perform additional actions or checks specific to 'owner' or 'staff'
            }

            // Perform logout action
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/login');
    }
}
