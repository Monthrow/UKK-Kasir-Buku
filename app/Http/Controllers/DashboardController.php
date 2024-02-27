<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\TransaksiDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $kategori = Kategori::count();
        $produk = Produk::count();
        $td = TransaksiDetail::count();
        
        return view('dashboard.index', compact('userCount', 'kategori', 'produk', 'td'));
    }
}
