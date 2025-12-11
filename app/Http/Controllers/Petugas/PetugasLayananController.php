<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PetugasLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function layanan()
    {
        $layanan = Layanan::all();
        return view('petugas.layanan.layanan', compact('layanan'));
    }

    //tampil create
    public function create()
    {
        return view('petugas.layanan.create');
    }

    //tambah data
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required|max:20',
                'nama_layanan' => 'required|max:50',
                'harga_perkilo' => 'required|max:50',
                'harga_perkilo' => 'required|max:10',
            ],
            [
                'kode.required' => 'Nama layanan wajib diisi',
                'kode.max' => 'Nama maksimal 20 karakter',
                'nama_layanan.required' => 'Nama layanan wajib diisi',
                'nama_layanan.max' => 'Nama maksimal 50 karakter',
                'harga_perkilo.required' => 'Harga Perkilo wajib diisi',
                'harga_perkilo.max' => 'jenis maksimal 50 karakter',
                'estimasi.required' => 'Harga Perkilo wajib diisi',
                'estimasi.max' => 'jenis maksimal 10 karakter',
            ]
        );
        //tambah data produk
        Layanan::create([
            'kode' => $request->kode,
            'nama_layanan' => $request->nama_layanan,
            'harga_perkilo' => $request->harga_perkilo,
            'estimasi' => $request->estimasi,
        ]);
        return redirect()->route('petugas.layanan');
    }

    //tampil edit
    public function edit(Layanan $id)
    {
        return view('petugas.layanan.edit', compact('id'));
    }

    //update 
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|max:20',
            'nama_layanan' => 'required|max:50',
            'harga_perkilo' => 'required|numeric',
            'estimasi' => 'required|numeric',
        ], [
            'kode.required' => 'Nama layanan wajib diisi',
            'kode.max' => 'Nama maksimal 20 karakter',
            'nama_layanan.required' => 'Nama layanan wajib diisi',
            'nama_layanan.max' => 'Nama maksimal 50 karakter',
            'harga_perkilo.required' => 'Harga Perkilo wajib diisi',
            'harga_perkilo.max' => 'jenis maksimal 50 karakter',
            'estimasi.required' => 'Harga Perkilo wajib diisi',
            'estimasi.max' => 'jenis maksimal 10 karakter',
        ]);
        //ambil produk lama
        $layanan = Layanan::find($id);

        //update data produk
        $layanan->update([
            'kode' => $request->kode,
            'nama_layanan' => $request->nama_layanan,
            'harga_perkilo' => $request->harga_perkilo,
            'estimasi' => $request->estimasi,
        ]);

        return redirect()->route('petugas.layanan');
    }
    //delete    
    public function delete(Layanan $id)
    {
        $id->delete();
        return redirect()->route('petugas.layanan')->with('success', 'Data berhasil dihapus');
    }
}
