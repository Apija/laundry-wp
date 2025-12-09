<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Laundry - {{ $laundry->resi }}</title>
    <style>
        /* Reset & Base */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font Modern */
            background-color: #f0f0f0; /* Warna latar belakang halaman (bukan struk) */
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Tampilan Kertas Struk */
        .struk-container {
            background-color: #fff;
            width: 80mm; /* Lebar standar kertas thermal 80mm */
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Efek bayangan kertas */
            border-radius: 5px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            text-transform: uppercase;
            color: #333;
        }
        .header p {
            font-size: 10px;
            color: #666;
            margin: 2px 0;
        }
        
        /* Garis Pemisah yang cantik */
        .divider {
            border-top: 2px dashed #ddd;
            margin: 10px 0;
        }
        .divider-solid {
            border-top: 1px solid #eee;
            margin: 10px 0;
        }

        /* Info Transaksi */
        .info-group {
            font-size: 11px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }
        .info-label {
            color: #666;
        }
        .info-value {
            font-weight: bold;
            color: #000;
        }

        /* Tabel Item */
        table {
            width: 100%;
            font-size: 11px;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            color: #888;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        td {
            padding: 8px 0;
            vertical-align: top;
        }
        .col-qty { text-align: center; width: 20%; }
        .col-price { text-align: right; width: 30%; }

        /* Total Section */
        .total-section {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 3px;
        }
        .grand-total {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #ccc;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #666;
        }
        
        /* Barcode Simulation */
        .barcode {
            margin: 15px auto 5px;
            height: 35px;
            background: repeating-linear-gradient(
                to right,
                #000 0px, #000 2px,
                transparent 2px, transparent 4px,
                #000 4px, #000 7px
            );
            width: 70%;
            opacity: 0.8;
        }

        /* Tombol Aksi */
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-print { background-color: #2c3e50; color: white; }
        .btn-dl { background-color: #27ae60; color: white; }
        .btn:hover { opacity: 0.9; }

        /* Pengaturan Print - PENTING */
        @media print {
            body { 
                background-color: white; 
                padding: 0; 
                margin: 0;
            }
            .struk-container {
                box-shadow: none;
                margin: 0;
                width: 100%; /* Full width printer */
                padding: 0;
            }
            .no-print { display: none !important; }
            /* Memaksa background color tercetak (opsional) */
            -webkit-print-color-adjust: exact;
        }
    </style>
</head>

<body onload="window.print()"> <div id="struk-area" class="struk-container">
        
        <div class="header">
            <div style="font-size: 30px; margin-bottom:5px;">🧺</div> 
            <h1>LAUNDRY KOE</h1>
            <p>Jl. Contoh No. 123, Jakarta Selatan</p>
            <p>WhatsApp: 0812-3456-7890</p>
        </div>

        <div class="divider"></div>

        <div class="info-group">
            <span class="info-label">No. Resi</span>
            <span class="info-value">#{{ $laundry->resi }}</span>
        </div>
        <div class="info-group">
            <span class="info-label">Tanggal</span>
            <span class="info-value">{{ date($laundry->tgl_masuk) }}</span>
        </div>
        <div class="info-group">
            <span class="info-label">Pelanggan</span>
            <span class="info-value">{{ strtoupper($laundry->pelanggan->nama ?? 'Umum') }}</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Layanan</th>
                    <th class="col-qty">Brt</th>
                    <th class="col-price">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span style="font-weight: 600;">{{ $laundry->layanan->nama_layanan ?? '-' }}</span>
                        <br><i style="font-size: 9px; color: #888;">Reguler Service</i>
                    </td>
                    <td class="col-qty">{{ $laundry->berat }} Kg</td>
                    <td class="col-price">Rp{{ number_format($laundry->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span>Subtotal</span>
                <span>Rp{{ number_format($laundry->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="total-row" style="color: #666;">
                <span>Diskon</span>
                <span>Rp0</span>
            </div>
            
            <div class="total-row grand-total">
                <span>TOTAL BAYAR</span>
                <span>Rp{{ number_format($laundry->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <div class="barcode"></div> <p style="margin-top: 5px;">TERIMA KASIH ATAS KUNJUNGAN ANDA</p>
            <p style="font-size: 9px;">*Barang tidak diambil > 30 hari di luar tanggung jawab kami.</p>
        </div>
    </div>

    <div class="action-buttons no-print">
        <button class="btn btn-print" onclick="window.print()">🖨 Cetak</button>
        <button class="btn btn-dl" onclick="downloadImage()">⬇ Download Gambar</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script>
        function downloadImage() {
            const element = document.getElementById('struk-area');
            
            // Opsi agar hasil download tajam
            html2canvas(element, {
                scale: 3, // Perbesar skala render
                backgroundColor: "#ffffff", // Pastikan background putih
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Struk-{{ $laundry->resi }}.jpg';
                link.href = canvas.toDataURL('image/jpeg', 0.9);
                link.click();
            });
        }
    </script>

</body>
</html>