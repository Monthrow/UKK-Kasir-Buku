<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= [
            'title'   => 'Manajemen Produk',
            'produk'=> Produk::paginate(10),
            'content' => 'admin/produk/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data= [
            'title'   => 'Tambah Produk',
            'kategori' => Kategori::get(),
            'content' => 'admin/produk/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);
        Produk::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data= [
            'title'   => 'Tambah Produk',
            'produk'=> Produk::find($id),
            'kategori' => Kategori::get(),
            'content' => 'admin/produk/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::find($id);
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            
        ]);
        $produk->update($data);
        Alert::success('Sukses', 'Data berhasil diedit!!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!!');
        return redirect()->back();
    }
}
