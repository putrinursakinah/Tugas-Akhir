<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Realisasi RKAS - Excel</title>
</head>
<body>
    <h3 align="center">LAPORAN REALISASI RKAS</h3>
    @if(isset($bulan))
    <p><strong>Bulan:</strong> {{ $bulan }}</p>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian</th>
                <th>Jumlah Pagu</th>
                <th>Realisasi</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPagu = 0; $totalRealisasi = 0; @endphp
            @foreach($dataanggaran as $index => $item)
                @php
                    $realisasi = $item->transaksi->sum('jumlah');
                    $sisa = $item->jumlah - $realisasi;
                    $totalPagu += $item->jumlah;
                    $totalRealisasi += $realisasi;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td align="right">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td align="right">{{ number_format($realisasi, 0, ',', '.') }}</td>
                    <td align="right">{{ number_format($sisa, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">Total</th>
                <th align="right">{{ number_format($totalPagu, 0, ',', '.') }}</th>
                <th align="right">{{ number_format($totalRealisasi, 0, ',', '.') }}</th>
                <th align="right">{{ number_format($totalPagu - $totalRealisasi, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>
</body>
</html>
