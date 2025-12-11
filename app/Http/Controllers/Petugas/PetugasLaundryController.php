<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Layanan;
use App\Models\Pelanggan;
use Barryvdh\DomPDF\Facade\Pdf;

class PetugasLaundryController extends Controller
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
        return response()->view('petugas.laundry.laundry', compact('laundry', 'layanan', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $layanan = Layanan::all();
        return view('petugas.laundry.create', compact('pelanggan', 'layanan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'berat' => 'required|numeric',
            'status' => 'required|max:45',
            'tgl_masuk' => 'required|date',
        ]);

        // Ambil layanan
        $layanan = Layanan::findOrFail($request->id_layanan);

        // ==========================
        // GENERATE RESI OTOMATIS
        // ==========================
        $tanggal = now()->format('ymd');
        $kode = $layanan->kode;

        $latest = Laundry::where('id_layanan', $request->id_layanan)
            ->whereDate('tgl_masuk', now())
            ->orderBy('id_laundry', 'desc')
            ->first();

        $urut = $latest ? intval(substr($latest->resi, -3)) + 1 : 1;
        $resi = $kode . $tanggal . str_pad($urut, 3, '0', STR_PAD_LEFT);

        // Hitung total harga
        $total_harga = $request->berat * $layanan->harga_perkilo;

        // ==========================
        // HITUNG TGL SELESAI OTOMATIS
        // ==========================
        $tgl_selesai = date('Y-m-d', strtotime($request->tgl_masuk . " + {$layanan->estimasi} days"));

        // Simpan data laundry
        Laundry::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'resi' => $resi,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'status' => $request->status,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_selesai' => $tgl_selesai,
        ]);

        return redirect()->route('petugas.laundry')->with('success', 'Laundry berhasil ditambahkan!');
    }

    public function delete(Laundry $id)
    {
        $id->delete();
        return redirect()->route('petugas.laundry')->with('success', 'Data berhasil dihapus');
    }

    public function cetakStruk($id_laundry)
    {
        // Ambil data laundry berdasarkan ID, lengkap dengan relasi pelanggan dan layanan
        $laundry = Laundry::with(['pelanggan', 'layanan'])->findOrFail($id_laundry);

        // Tampilkan view khusus struk
        return view('petugas.laundry.struk', compact('laundry'));
    }
    public function updateStatus(Request $request, $id)
    {
        $laundry = Laundry::findOrFail($id);

        // Update status sesuai pilihan dropdown
        $laundry->status = $request->status;
        $laundry->save();

        return redirect()->back()->with('success', 'Status berhasil diubah!');
    }

    public function exportLaporan(Request $request)
    {
        // 1. Logika Filter (Sama seperti sebelumnya)
        $query = Laundry::with(['pelanggan', 'layanan']);
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
        $totalPendapatan = $data->where('status', '!=', 'Dibatalkan')->sum('total_harga');

        // 2. Cek Format Download (PDF atau Excel)
        if ($request->format == 'pdf') {
            // Load View khusus PDF
            $pdf = Pdf::loadView('petugas.laundry.export_excel', compact('data', 'periode', 'totalPendapatan'));
            // Atur kertas jadi Landscape agar tabel muat
            $pdf->setPaper('a4', 'landscape');
            return $pdf->download($judul . '.pdf');
        } else {
            // Format Excel (Menggunakan View HTML agar Rapi ada garisnya)
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$judul.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('petugas.laundry.export_excel', compact('data', 'periode', 'totalPendapatan'));
        }
    }
}
