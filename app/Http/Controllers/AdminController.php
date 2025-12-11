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
                'email' => 'required|max:45|email|unique:users,email',
                'role' => 'required|in:admin,petugas',
                'password' => 'required|confirmed|max:45',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'role.required' => 'Role wajib dipilih',
                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => strtolower($request->role), // <<< WAJIB
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
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
                'role' => 'required|in:admin,petugas',
                'password' => 'nullable|confirmed|max:45',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'name.max' => 'Nama maksimal 45 karakter',
                'email.required' => 'Email wajib diisi',
                'email.max' => 'Email maksimal 45 karakter',
                'role.required' => 'Role wajib dipilih',
                'password.max' => 'Password maksimal 45 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]
        );

        //ambil user
        $user = User::find($id);

        //update data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = strtolower($request->role);

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // SIMPAN
        $user->save();

        return redirect()->route('user')->with('success', 'Data berhasil diedit');
    }

    //delete
    public function delete(user $id)
    {
        $id->delete();

        return redirect()->route('user')->with('success', 'Data berhasil dihapus');
    }
}
