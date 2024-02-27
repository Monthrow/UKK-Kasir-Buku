<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'user'    => User::get(),
            'title'   => 'Manajemen Anggota',
            'content' => 'admin.user.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|regex:/[0-9]/|confirmed',
            'level' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        Alert::success('Sukses', 'Data berhasil ditambahkan!!');
        return redirect('/aplikasikasir/user')->with('success', 'Data berhasil ditambahkan!!');
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
        $data = [
            'user'    => User::find($id),
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user= User::find($id);
        $data= $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            //'password' => 'required',
            'level' => 'required',
            're_password' => 'same:password',
        ]);

        if($request->password != ''){
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }
    
        $user->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate!!');
        return redirect('/aplikasikasir/user')->with('success', 'Data berhasil diedit!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!!');
        return redirect('/aplikasikasir/user')->with('success', 'Data berhasil dihapus!!');
    }
}
