<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Layanan;
use App\Models\Pelanggan;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function laundry()
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        $laundry = Laundry::with(['pelanggan', 'layanan'])->get();
        return response()->view('laundry.laundry', compact('laundry', 'layanan', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        return view('laundry.create', compact('pelanggan', 'layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
                'id_layanan' => 'required|exists:layanans,id_layanan',
                'berat' => 'required|numeric',
                'status' => 'required|max:45',
                'tgl_masuk' => 'required|date',
                'tgl_selesai' => 'required|date',
            ]
        );

        // Ambil data layanan
        $layanan = Layanan::findOrFail($request->id_layanan);

        // ==========================
        // GENERATE RESI OTOMATIS
        // ==========================

        // Format tanggal ymd
        $tanggal = now()->format('ymd');

        // Ambil kode layanan
        $kode = $layanan->kode;

        // Cari resi terakhir per hari + layanan
        $latest = Laundry::where('id_layanan', $request->id_layanan)
            ->whereDate('tgl_masuk', now())
            ->orderBy('id_laundry', 'desc')
            ->first();

        // Nomor urut 3 digit
        $urut = $latest ? intval(substr($latest->resi, -3)) + 1 : 1;

        // Buat resi final → EXP250125001
        $resi = $kode . $tanggal . str_pad($urut, 3, '0', STR_PAD_LEFT);

        // ==========================
        // HITUNG TOTAL HARGA
        // ==========================
        $total_harga = $request->berat * $layanan->harga_perkilo;

        // Simpan ke database
        Laundry::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'resi' => $resi,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'status' => $request->status,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return redirect('laundry')->with('success', 'Laundry berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laundry $id)
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        return view('laundry.edit', compact('id', 'pelanggan', 'layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
                'id_layanan' => 'required|exists:layanans,id_layanan',
                'berat' => 'required|numeric',
                'status' => 'required|max:45',
                'tgl_masuk' => 'required|date',
                'tgl_selesai' => 'required|date',
            ],
            [
                'id_pelanggan.required' => 'Nama pelanggan wajib diisi',
                'id_pelanggan.max' => 'Nama maksimal 45 karakter',

                'id_layanan.required' => 'Nama layanan wajib diisi',
                'id_layanan.max' => 'Nama layanan maksimal 45 karakter',

                'berat.required' => 'Berat cucian wajib diisi',
                'berat.numeric' => 'Berat harus berupa angka',

                'status.required' => 'Status wajib diisi',
                'status.max' => 'Status maksimal 45 karakter',

                'tgl_masuk.required' => 'Tanggal masuk wajib diisi',
                'tgl_masuk.date' => 'Tanggal masuk harus format tanggal yang valid',

                'tgl_selesai.required' => 'Tanggal selesai wajib diisi',
                'tgl_selesai.date' => 'Tanggal selesai harus format tanggal yang valid',
            ]
        );
        // Hitung total harga di backend
        $layanan = Layanan::findOrFail($request->id_layanan);
        $total_harga = $request->berat * $layanan->harga_perkilo;

        //ambil produk lama
        $laundry = Laundry::findOrFail($id);

        //tambah data produk
        $laundry->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'resi' => $request->resi,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'status' => $request->status,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_selesai' => $request->tgl_selesai,

        ]);
        return redirect('laundry')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy(string $id)
    {
        //
    }
}
