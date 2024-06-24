<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthGlobalProvider extends ServiceProvider
{
    public function boot()
    {
        if (Auth::check()) {
            Session::put('user', Auth::user());
        }
    }
}