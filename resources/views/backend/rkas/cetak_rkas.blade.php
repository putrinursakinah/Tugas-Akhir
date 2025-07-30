@extends('admin.admin_master')
@section('title','Cetak RKAS')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="text-left mb-4">
                <h3 class="text-primary">RINCIAN KERTAS KERJA RKAS</h3>
                <h5 class="text-primary">SMK Alawiyah</h5>
                <h6 class="text-primary">TAHUN PELAJARAN 2025/2026</h6>
            </div>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Kode/Akun</th>
                        <th>Uraian</th>
                        <th>Vol</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>PSBD</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataAnggaran as $row)
                    <tr>
                        <td>{{ $row->kode_akun ?? '-' }}</td>
                        <td>{{ $row->uraian }}</td>
                        <td>{{ $row->vol }}</td>
                        <td>{{ $row->satuan }}</td>
                        <td>{{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                        <td>{{ number_format($row->jumlah, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data RKAS yang ditemukan.</td>
                    </tr>
                    @endforelse

                    {{-- Total --}}
                    <tr>
                        <td colspan="5" class="font-weight-bold text-end">Total</td>
                        <td class="font-weight-bold">{{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <button onclick="window.print();" class="btn btn-primary">Cetak</button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .container-fluid, .container-fluid * {
            visibility: visible;
        }
        .container-fluid {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>

@endsection
