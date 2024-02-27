<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= [
            'title'   => 'Manajemen Penerbit',
            'penerbit'=> Penerbit::get(),
            'content' => 'admin/penerbit/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data= [
            'title'   => 'Tambah Penerbit',
            'content' => 'admin/penerbit/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:penerbits'
        ]);
        Penerbit::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect('/aplikasikasir/penerbit')->with('success', 'Data berhasil ditambahkan!!');
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
            'title'   => 'Tambah Penerbit',
            'penerbit'=> Penerbit::find($id),
            'content' => 'admin/penerbit/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penerbit = Penerbit::find($id);
        $data = $request->validate([
            'name' => 'required|unique:penerbits,name,' . $penerbit->id
        ]);
        $penerbit->update($data);
        Alert::success('Sukses', 'Data berhasil diedit!!');
        return redirect('/aplikasikasir/penerbit')->with('success', 'Data berhasil ditambahkan!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerbit = Penerbit::find($id);
        $penerbit->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!!');
        return redirect()->back();
    }
}
