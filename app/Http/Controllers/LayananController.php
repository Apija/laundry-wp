<?php

namespace App\Http\Controllers;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function layanan()
    {
        $layanan = Layanan::all();
        return view('layanan.layanan', compact('layanan'));
    }

    //tampil create
    public function create()
    {
        return view('layanan.create');
    }

    //tambah data
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required|max:20',
                'nama_layanan' => 'required|max:50',
                'harga_perkilo' => 'required|max:50',
            ],
            [
                'kode.required' => 'Nama layanan wajib diisi',
                'kode.max' => 'Nama maksimal 20 karakter',
                'nama_layanan.required' => 'Nama layanan wajib diisi',
                'nama_layanan.max' => 'Nama maksimal 50 karakter',
                'harga_perkilo.required' => 'Harga Perkilo wajib diisi',
                'harga_perkilo.max' => 'jenis maksimal 50 karakter',
            ]
        );
        //tambah data produk
        Layanan::create([
            'kode' => $request->kode,
            'nama_layanan' => $request->nama_layanan,
            'harga_perkilo' => $request->harga_perkilo,
        ]);
        return redirect('layanan');
    }

    //tampil edit
    public function edit(Layanan $id)
    {
        return view('layanan.edit', compact('id'));
    }

    //update 
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|max:20',
            'nama_layanan' => 'required|max:50',
            'harga_perkilo' => 'required|numeric',
        ], [
            'kode.required' => 'Nama layanan wajib diisi',
            'kode.max' => 'Nama maksimal 20 karakter',
            'nama_layanan.required' => 'Nama layanan wajib diisi',
            'nama_layanan.max' => 'Nama maksimal 50 karakter',
            'harga_perkilo.required' => 'Harga Perkilo wajib diisi',
            'harga_perkilo.max' => 'jenis maksimal 50 karakter',
        ]);
        //ambil produk lama
        $layanan = Layanan::find($id);

        //update data produk
        $layanan->update([
            'kode' => $request->kode,
            'nama_layanan' => $request->nama_layanan,
            'harga_perkilo' => $request->harga_perkilo,
        ]);

        return redirect('layanan');
    }
    //delete    
    public function delete(Layanan $id)
    {
        $id->delete();
        return redirect('layanan')->with('success', 'Data berhasil dihapus');
    }
}
