<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    //tampilan table
    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.pelanggan', compact('pelanggan'));
    }
    // Tampil tambah data
    public function create()
    {
        return view('pelanggan.create');
    }
    
    //menyimpan data
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|max:45',
                'no_hp' => 'required|max:12',
                'alamat' => 'required|max:70',
            ],
            [
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama maksimal 45 karakter',
                'no_hp.required' => 'jenis wajib diisi',
                'no_hp.max' => 'jenis maksimal 12 karakter',
                'alamat.required' => 'jenis wajib diisi',
                'alamat.max' => 'jenis maksimal 70 karakter',
            ]
        );
        //tambah data produk
        Pelanggan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);
        return redirect('pelanggan');
    }
    //Tampil Edit
    public function edit(Pelanggan $id)
    {
        return view('pelanggan.edit', compact('id'));
    }

    
    //Update the specified resource in storage.
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:20',
            'no_hp' => 'required|max:12',
            'alamat' => 'required|max:70',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 20 karakter',
            'no_hp.required' => 'jenis wajib diisi',
            'no_hp.max' => 'jenis maksimal 12 karakter',
            'alamat.required' => 'jenis wajib diisi',
            'alamat.max' => 'jenis maksimal 70 karakter',
        ]);

        //ambil produk lama
        $pelanggan = Pelanggan::find($id);

        //update data produk
        $pelanggan->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect('pelanggan');
    }
    //delete
    public function delete(Pelanggan $id)
    {
        $id->delete();

        return redirect('pelanggan')->with('success', 'Data berhasil dihapus');
    }
}
