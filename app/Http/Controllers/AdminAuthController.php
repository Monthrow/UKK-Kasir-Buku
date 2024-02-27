<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    function index(){
        return view('admin.auth.login');
    }

    // public function forgot_password()
    // {
    //     return view('admin.auth.forgot-password');
    // }

    // public function forgot_password_act(Request $request)
    // {
    //     $customMessage = [
    //         'email.required'    => 'Email tidak boleh kosong',
    //         'email.email'       => 'Email tidak valid',
    //         'email.exists'      => 'Email tidak terdaftar di database',
    //     ];

    //     $request->validate([
    //         'email' => 'required|email|exists:users,email'
    //     ], $customMessage);

    //     $token = \Str::random(60);

    //     PasswordResetToken::updateOrCreate(
    //         [
    //             'email' => $request->email
    //         ],
    //         [
    //             'email' => $request->email,
    //             'token' => $token,
    //             'created_at' => now(),
    //         ]
    //     );

    //     Mail::to($request->email)->send(new ResetPasswordMail($token));

    //     return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    // }

    // public function validasi_forgot_password_act(Request $request)
    // {
    //     $customMessage = [
    //         'password.required' => 'Password tidak boleh kosong',
    //         'password.min'      => 'Password minimal 6 karakter',
    //     ];

    //     $request->validate([
    //         'password' => 'required|min:6'
    //     ], $customMessage);

    //     $token = PasswordResetToken::where('token', $request->token)->first();

    //     if (!$token) {
    //         return redirect()->route('login')->with('failed', 'Token tidak valid');
    //     }

    //     $user = User::where('email', $token->email)->first();

    //     if (!$user) {
    //         return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
    //     }

    //     $user->update([
    //         'password' => Hash::make($request->password)
    //     ]);

    //     $token->delete();

    //     return redirect()->route('login')->with('success', 'Password berhasil direset');
    // }

    // public function validasi_forgot_password(Request $request, $token)
    // {
    //     $getToken = PasswordResetToken::where('token', $token)->first();

    //     if (!$getToken) {
    //         return redirect()->route('login')->with('failed', 'Token tidak valid');
    //     }

    //     return view('admin.auth.validasi-token', compact('token'));
    // }

    function register(){
        $user = User::all();
        return view('admin.auth.register', compact('user'));
    }

    function doRegister(Request $request){
        $data= $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'level' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect('/login')->with('success', 'Data berhasil ditambahkan!!');
    }

    function doLogin(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();

            if($user->level == 'Admin'){
                Alert::success('Sukses', 'Selamat Datang Admin');
                return redirect('/aplikasikasir/dashboard');
            }else {
                Alert::success('Sukses', 'Selamat Datang Kasir');
                return redirect('/aplikasikasir/transaksi');
            }
        }
        else {
            return back()->with('status', 'Email atau Password salah!');
        }
    }

    public function store(Request $request)
    {
        
            

        $data= $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'level' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect('/aplikasikasir/user')->with('success', 'Data berhasil ditambahkan!!');
        
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    }
}
