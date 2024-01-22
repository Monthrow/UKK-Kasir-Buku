<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\AdminUserController;
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
Route::post('login/do', [AdminAuthController::class, 'doLogin'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::get('/', function () {
    $data = [
        'content' => 'admin.dashboard.index'
    ];
    return view('admin.layouts.wrapper', $data);
})->middleware('auth');

Route::prefix('/admin')->middleware('auth')->group(function(){
    Route::get('/dashboard', function(){
        $data = [
            'content' => 'admin.dashboard.index'
        ];
        return view('admin.layouts.wrapper', $data);
    });
    Route::resource('/user', AdminUserController::class);
});

Route::group(['middleware' => ['auth', 'ceklevel:Admin']], function(){
    Route::get('/admin/transaksi/detail/selesai/{id}',[AdminTransaksiDetailController::class, 'done']);
    Route::get('/admin/transaksi/detail/delete',[AdminTransaksiDetailController::class, 'delete']);
    Route::post('/admin/transaksi/detail/create',[AdminTransaksiDetailController::class, 'create']);
    Route::resource('/admin/transaksi', AdminTransaksiController::class);
    Route::resource('/admin/produk', AdminProdukController::class);
    Route::resource('/admin/kategori', AdminKategoriController::class);
    Route::resource('/admin/user', AdminUserController::class);
});

Route::group(['middleware' => ['auth', 'ceklevel:Admin,Kasir']], function(){
    Route::get('/admin/transaksi/detail/selesai/{id}',[AdminTransaksiDetailController::class, 'done']);
    Route::get('/admin/transaksi/detail/delete',[AdminTransaksiDetailController::class, 'delete']);
    Route::post('/admin/transaksi/detail/create',[AdminTransaksiDetailController::class, 'create']);
    Route::resource('/admin/transaksi', AdminTransaksiController::class);
    Route::resource('/admin/produk', AdminProdukController::class);
    Route::resource('/admin/kategori', AdminKategoriController::class);
});

    