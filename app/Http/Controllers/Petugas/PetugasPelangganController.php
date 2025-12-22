<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PetugasPelangganController extends Controller
{
    //tampilan table
    public function pelanggan()
    {
        $pelanggan = Pelanggan::all();
        return view('petugas.pelanggan.pelanggan', compact('pelanggan'));
    }
    // Tampil tambah data
    public function create()
    {
        return view('petugas.pelanggan.create');
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
        return redirect()->route('petugas.pelanggan');
    }
    //Tampil Edit
    public function edit(Pelanggan $id)
    {
        return view('petugas.pelanggan.edit', compact('id'));
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

        return redirect()->route('petugas.pelanggan');
    }
    //delete
    public function delete(Pelanggan $id)
    {
        $id->delete();

        return redirect()->route('petugas.pelanggan')->with('success', 'Data berhasil dihapus');
    }
    public function exportLaporan(Request $request)
    {
        // 1. Ambil SEMUA data member dari database
        $data = Pelanggan::latest()->get();

        $judul = "Laporan-Member";

        // 2. Cek Format (PDF atau Excel)
        if ($request->format == 'pdf') {
            $pdf = Pdf::loadView('pelanggan.export_excel', compact('data'));
            $pdf->setPaper('a4', 'portrait');
            return $pdf->download($judul . '.pdf');
        } else {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$judul.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('pelanggan.export_excel', compact('data'));
        }
    }
}
