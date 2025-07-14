@extends('admin.admin_master')
@section('title','Pagu Transaksi')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-square"></i> Pagu Transaksi
            </h6>
        </div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paguModalLabel">PILIH PAGU ANGGARAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="searchData" class="form-control" placeholder="Cari Data">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Kode/Akun</th>
                                <th>Uraian</th>
                                <th>Pagu Anggaran</th>
                                <th>Realisasi</th>
                                <th>Sisa Anggaran</th>
                                <th>Pilih Pagu</th>
                            </tr>
                        </thead>
                        <tbody id="paguTableBody">
                            @foreach ($pendapatan as $item)
                            <tr>
                                <td>{{ $item->kode_akun }}</td>
                                <td>{{ $item->uraian }}</td>
                                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td> <!-- Pagu Anggaran -->
                                <td>{{ number_format($belanja_jumlah, 0, ',', '.') }}</td> <!-- Realisasi -->
                                <td>{{ number_format($surplus, 0, ',', '.') }}</td> <!-- Sisa Anggaran -->
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="pilihPagu('{{ $item->kode_akun }}')">Pilih</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function pilihPagu(kode) {
    console.log("Pagu dipilih: " + kode);
    $('#paguModal').modal('hide');
}
</script>

@endsection