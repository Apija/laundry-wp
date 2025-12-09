<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //tampilan table
    public function user()
    {
        $user = User::all();
        return view('admin.admin', compact('user'));
    }

    // Tampil tambah data
    public function create()
    {
        return view('admin.create');
    }

    //menyimpan data
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:45',
                'email' => 'required|max:45',
                'password' => 'required|max:45',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'name.max' => 'Nama maksimal 45 karakter',
                'email.required' => 'jenis wajib diisi',
                'email.max' => 'jenis maksimal 45 karakter',
                'password.required' => 'jenis wajib diisi',
                'password.max' => 'jenis maksimal 45 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]
        );
        //tambah data 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('user');
    }
    //Tampil Edit
    public function edit(User $id)
    {
        return view('admin.edit', compact('id'));
    }


    //Update the specified resource in storage.

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|max:45',
                'email' => 'required|max:45',
                'password' => 'nullable|confirmed|max:45',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'name.max' => 'Nama maksimal 45 karakter',
                'email.required' => 'jenis wajib diisi',
                'email.max' => 'jenis maksimal 45 karakter',
                'password.max' => 'jenis maksimal 45 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]
        );

        //ambil produk lama
        $user = User::find($id);
    
        //update data produk
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        return redirect()->route('user')->with('success', 'Data berhasil diedit');
    }
    //delete
    public function delete(user $id)
    {
        $id->delete();

        return redirect()->route('user')->with('success', 'Data berhasil dihapus');
    }
}
