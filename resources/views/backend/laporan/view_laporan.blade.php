@extends('admin.admin_master')
@section('title','Laporan Realisasi SPP')
@section('admin')
<div class="container my-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h3 class="card-title mb-4 text-primary fw-bold">📊 Laporan Realisasi Anggaran</h3>

            <form method="GET" action="{{ route('laporan.realisasi') }}">
                <div class="row align-items-end gy-3">
                    <div class="col-md-4">
                        <label for="bulan" class="form-label fw-semibold">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-select shadow-sm">
                            @foreach(range(1, 12) as $bln)
                            <option value="{{ $bln }}" {{ request('bulan', now()->month) == $bln ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($bln)->locale('id')->translatedFormat('F') }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            <i class="fas fa-search me-1"></i> Tampilkan
                        </button>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('laporan.realisasi.pdf', ['bulan' => request('bulan', now()->month)]) }}" class="btn btn-secondary">
                            <i class="fas fa-file-pdf"></i> Cetak PDF
                        </a>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><strong>RINCIAN RKAS/M</strong></div>
    <div class="card-body">
        <input type="text" class="form-control mb-3" placeholder="Cari Data" onkeyup="filterTable(this.value)">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="rkasTable">
                <thead class="table-light">
                    <tr>
                        <th>Kode/Akun</th>
                        <th>Uraian</th>
                        <th>Pagu anggaran</th>
                        <th>Realisasi</th>
                        <th>Realisasi Netto</th>
                        <th>Sisa Anggaran</th>
                        <th>% Realisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $kategori)
                    <tr>
                        <td class="text-danger font-weight-bold">{{ $kategori->id_kategori }}</td>
                        <td class="text-danger font-weight-bold">{{ $kategori->nama_kategori }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @php $totalKategori = 0; @endphp

                    @foreach($kegiatan as $keg)
                    @if($keg->kategori_id_kategori == $kategori->id_kategori)
                    @php
                    $jumlah_kegiatan = 0;
                    foreach($dataanggaran as $anggaran) {
                    if($anggaran->kode_kegiatan_id_kegiatan == $keg->id_kegiatan) {
                    $jumlah_kegiatan += $anggaran->jumlah;
                    $totalKategori += $anggaran->jumlah;
                    }
                    }
                    @endphp
                    <tr>
                        <td>{{ $keg->kode }}</td>
                        <td>{{ $keg->kegiatan }}</td>
                        <td>{{ number_format($jumlah_kegiatan, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>

                    @foreach($komponen as $kom)
                    @if($kom->kode_kegiatan_id_kegiatan == $keg->id_kegiatan)
                    @php
                    $jumlah_komponen = 0;
                    foreach($dataanggaran as $anggaran) {
                    if($anggaran->komponen_id_komponen == $kom->id_komponen) {
                    $jumlah_komponen += $anggaran->jumlah;
                    }
                    }
                    @endphp
                    <tr>
                        <td>{{ $kom->kode }}</td>
                        <td>{{ $kom->uraian }}</td>
                        <td>{{ number_format($jumlah_komponen, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @foreach($kode_akun as $akun)
                    @if($akun->id_akun == $kom->kode_akun_id_akun)
                    @php
                    $jumlah_akun = 0;
                    foreach($dataanggaran as $anggaran) {
                    if($anggaran->komponen_id_komponen == $kom->id_komponen) {
                    $jumlah_akun += $anggaran->jumlah;
                    }
                    }
                    @endphp
                    <tr>
                        <td>{{ $akun->kode }}</td>
                        <td>{{ $akun->kegiatan }}</td>
                        <td>{{ number_format($jumlah_akun, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    @endif
                    @endforeach

                    @foreach($dataanggaran as $anggaran)
                    @if($anggaran->komponen_id_komponen == $kom->id_komponen)
                    @php
                    $pagu = $anggaran->jumlah ?? 0;
                    $realisasi_debet = $anggaran->transaksi->sum('debet');
                    $realisasi_kredit = $anggaran->transaksi->sum('kredit');
                    $realisasi = $realisasi_debet - $realisasi_kredit;
                    $sisa = $pagu - $realisasi;
                    $persen = $pagu > 0 ? number_format(($realisasi / $pagu) * 100, 2) : 0;
                    @endphp
                    <tr>
                        <td></td>
                        <td>{{ $anggaran->uraian }}</td>
                        <td>{{ number_format($pagu, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($realisasi_debet, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($realisasi, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($sisa, 0, ',', '.') }}</td>
                        <td>{{ $persen }}%</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                    @endforeach

                    <tr class="bg-light font-weight-bold">
                        <td colspan="5" class="text-right">Total {{ $kategori->nama_kategori }}</td>
                        <td>{{ number_format($totalKategori, 0, ',', '.') }}</td>
                        <td></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

{{-- Script filter pencarian --}}
<script>
    function filterTable(keyword) {
        const table = document.getElementById('rkasTable');
        const rows = table.getElementsByTagName('tr');
        keyword = keyword.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let rowText = '';
            for (let j = 0; j < cells.length; j++) {
                rowText += cells[j].innerText.toLowerCase();
            }
            rows[i].style.display = rowText.includes(keyword) ? '' : 'none';
        }
    }
</script>
</tbody>
</table>
</div>
</div>
@endsection