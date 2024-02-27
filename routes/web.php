<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminPenerbitController;
use App\Http\Controllers\AdminPublisherController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register/do', [AdminAuthController::class, 'doRegister'])->name('doRegister');
Route::post('login/do', [AdminAuthController::class, 'doLogin'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::get('/forgot-password', function () {
    return view('admin.auth.forgot-password');
})->middleware('guest')->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}', function (string $token) {
    return view('admin.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:5|regex:/[0-9]/|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ( $user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );


    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::get('/', function () {
    $data = [
        'content' => 'admin.dashboard.index'
    ];
    return view('admin.layouts.wrapper', $data);
})->middleware('auth');

Route::prefix('/aplikasikasir')->middleware('auth')->group(function(){
    
    Route::resource('/user', AdminUserController::class);
});

Route::group(['middleware' => ['auth', 'ceklevel:Admin']], function(){
    Route::get('/aplikasikasir/transaksi/detail/selesai/{id}',[AdminTransaksiDetailController::class, 'done']);
    Route::get('/aplikasikasir/transaksi/detail/delete',[AdminTransaksiDetailController::class, 'delete']);
    Route::post('/aplikasikasir/transaksi/detail/create',[AdminTransaksiDetailController::class, 'create']);
    Route::resource('/aplikasikasir/transaksi', AdminTransaksiController::class);
    Route::resource('/aplikasikasir/produk', AdminProdukController::class);
    Route::resource('/aplikasikasir/kategori', AdminKategoriController::class);
    Route::resource('/aplikasikasir/user', AdminUserController::class);
    Route::resource('/aplikasikasir/penerbit', AdminPenerbitController::class);
    Route::resource('/aplikasikasir/genre', AdminPublisherController::class);

    
});

Route::group(['middleware' => ['auth', 'ceklevel:Admin,Kasir']], function(){
    Route::get('/aplikasikasir/transaksi/detail/selesai/{id}',[AdminTransaksiDetailController::class, 'done']);
    Route::get('/aplikasikasir/transaksi/{id}/print',[AdminTransaksiController::class, 'print']);
    Route::post('/aplikasikasir/transaksi/{id}/dibayarkan',[AdminTransaksiController::class, 'dibayarkan']);
    Route::get('/aplikasikasir/transaksi/detail/delete',[AdminTransaksiDetailController::class, 'delete']);
    Route::post('/aplikasikasir/transaksi/detail/create',[AdminTransaksiDetailController::class, 'create']);
    Route::resource('/aplikasikasir/transaksi', AdminTransaksiController::class);
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    Route::resource('/aplikasikasir/produk', AdminProdukController::class);
    Route::resource('/aplikasikasir/kategori', AdminKategoriController::class);

    Route::get('/aplikasikasir/dashboard', function(){
        $today = Carbon::today();
        $data = [
            'userCount' => \App\Models\User::count(),
            'kategori' => \App\Models\Kategori::count(),
            'produk' => \App\Models\Produk::count(),
            'totalTransaksi' => \App\Models\TransaksiDetail::count(),
            'td' => \App\Models\TransaksiDetail::whereDate('created_at', $today)->count(),
            'totalBiayaPembelian' => \App\Models\Transaksi::whereDate('created_at', $today)->sum('total'),
            'content' => 'admin.dashboard.index',
        ];
        return view('admin.layouts.wrapper', $data);
    });
});

    