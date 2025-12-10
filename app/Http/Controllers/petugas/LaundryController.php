<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Layanan;
use App\Models\Pelanggan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function laundry(Request $request)
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        $laundry = Laundry::with(['pelanggan', 'layanan'])->get();
        $query = Laundry::with(['pelanggan', 'layanan']);
        // Cek apakah user memilih bulan (request 'filter_bulan' tidak kosong)
        if ($request->has('filter_bulan') && $request->filter_bulan != '') {
            // Input type="month" menghasilkan format "YYYY-MM" (contoh: 2023-12)
            $bulanTahun = $request->filter_bulan;
            $pecah = explode('-', $bulanTahun); // Pisahkan Tahun dan Bulan
            $tahun = $pecah[0];
            $bulan = $pecah[1];

            // Filter berdasarkan kolom tgl_masuk
            $query->whereYear('tgl_masuk', $tahun)
                ->whereMonth('tgl_masuk', $bulan);
        }

        // Ambil datanya (urutkan dari yang terbaru)
        $laundry = $query->latest()->get();
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

    public function delete(Laundry $id)
    {
        $id->delete();
        return redirect('laundry')->with('success', 'Data berhasil dihapus');
    }

    public function cetakStruk($id_laundry)
    {
        // Ambil data laundry berdasarkan ID, lengkap dengan relasi pelanggan dan layanan
        $laundry = \App\Models\Laundry::with(['pelanggan', 'layanan'])->findOrFail($id_laundry);

        // Tampilkan view khusus struk
        return view('laundry.struk', compact('laundry'));
    }
    public function updateStatus(Request $request, $id)
    {
        $laundry = \App\Models\Laundry::findOrFail($id);

        // Update status sesuai pilihan dropdown
        $laundry->status = $request->status;
        $laundry->save();

        return redirect()->back()->with('success', 'Status berhasil diubah!');
    }

    public function exportLaporan(Request $request)
    {
        // 1. Logika Filter (Sama seperti sebelumnya)
        $query = \App\Models\Laundry::with(['pelanggan', 'layanan']);
        $judul = "Laporan-Laundry";
        $periode = "";

        if ($request->jenis == 'bulanan' && $request->has('filter_bulan')) {
            $parts = explode('-', $request->filter_bulan);
            $query->whereYear('tgl_masuk', $parts[0])
                ->whereMonth('tgl_masuk', $parts[1]);
            $judul .= "-Bulanan-" . $request->filter_bulan;
            $periode = "Bulan: " . date('F Y', strtotime($request->filter_bulan));
        } elseif ($request->jenis == 'mingguan' && $request->has('filter_minggu')) {
            $dto = new \DateTime();
            $dto->setISODate((int)substr($request->filter_minggu, 0, 4), (int)substr($request->filter_minggu, 6));
            $start = $dto->format('Y-m-d');
            $dto->modify('+6 days');
            $end = $dto->format('Y-m-d');

            $query->whereBetween('tgl_masuk', [$start, $end]);
            $judul .= "-Mingguan-" . $request->filter_minggu;
            $periode = "Minggu: $start s/d $end";
        }

        $data = $query->get();
        $totalPendapatan = $data->sum('total_harga');

        // 2. Cek Format Download (PDF atau Excel)
        if ($request->format == 'pdf') {
            // Load View khusus PDF
            $pdf = Pdf::loadView('laundry.export_excel', compact('data', 'periode', 'totalPendapatan'));
            // Atur kertas jadi Landscape agar tabel muat
            $pdf->setPaper('a4', 'landscape');
            return $pdf->download($judul . '.pdf');
        } else {
            // Format Excel (Menggunakan View HTML agar Rapi ada garisnya)
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$judul.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('laundry.export_excel', compact('data', 'periode', 'totalPendapatan'));
        }
    }
}
