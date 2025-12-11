<!DOCTYPE html>
<html>
<head>
    <title>Laporan Laundry</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; color: #555; }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000; /* Garis hitam tegas */
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #d1e7dd; /* Warna hijau muda header */
            font-weight: bold;
            text-align: center;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>LAPORAN PEMASUKAN LAUNDRY</h2>
    <p>{{ $periode }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal Masuk</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Berat</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $item)
            <tr class="{{ $item->status == 'Dibatalkan' ? 'bg-red-200' : '' }}">
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->tgl_masuk }}</td>
                <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                <td>{{ $item->layanan->nama_layanan ?? '-' }}</td>
                <td style="mso-number-format:'\@'">{{ $item->resi }}</td>
                <td>{{ $item->status }}</td>
                <td class="text-center">{{ $item->berat }} Kg</td>
                <td class="text-right">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            
            <tr class="total-row">
                <td colspan="7" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>