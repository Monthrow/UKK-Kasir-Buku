<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPublisherController extends Controller
{
    public function index()
    {
        $data= [
            'title'   => 'Manajemen Genre',
            'publisher'=> Publisher::get(),
            'content' => 'admin/genre/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data= [
            'title'   => 'Tambah Genre',
            'content' => 'admin/genre/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:publishers'
        ]);
        Publisher::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect('/aplikasikasir/genre')->with('success', 'Data berhasil ditambahkan!!');
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
            'title'   => 'Tambah Publisher',
            'publisher'=> Publisher::find($id),
            'content' => 'admin/genre/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publisher = Publisher::find($id);
        $data = $request->validate([
            'name' => 'required|unique:publishers,name,' . $publisher->id
        ]);
        $publisher->update($data);
        Alert::success('Sukses', 'Data berhasil diedit!!');
        return redirect('/aplikasikasir/genre')->with('success', 'Data berhasil ditambahkan!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!!');
        return redirect()->back();
    }
}
