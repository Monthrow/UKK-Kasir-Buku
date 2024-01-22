<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    function index(){
        return view('admin.auth.login');
    }

    function doLogin(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();

            if($user->level == 'Admin'){
                return redirect('/admin/dashboard');
            }else {
                return redirect('/admin/transaksi');
            }
        }
        else {
            return back()->with('status', 'Email atau Password salah!');
        }
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    }
}