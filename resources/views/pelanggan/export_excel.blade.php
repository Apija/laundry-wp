<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Member</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #d1e7dd; /* Warna hijau muda Excel */
            font-weight: bold;
            text-align: center;
        }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <h2>LAPORAN DATA MEMBER LAUNDRY</h2>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Member</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->nama }}</td>
                
                <td class="text-center" style="mso-number-format:'\@'">
                    {{ $item->no_hp ?? $item->no_hp ?? '-' }}
                </td>
                
                <td>{{ $item->alamat ?? '-' }}</td>
                
                <td class="text-center">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data member.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>