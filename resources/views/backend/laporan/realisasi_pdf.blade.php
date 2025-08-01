<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Realisasi RKAS</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Realisasi RKAS</h2>
    <p>Bulan: {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian</th>
                <th>Jumlah Anggaran</th>
                <th>Realisasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataanggaran as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>
                        {{ number_format($item->transaksi->sum('jumlah'), 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
