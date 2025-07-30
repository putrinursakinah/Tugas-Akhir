@extends('admin.admin_master')
@section('title','Transaksi')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> Daftar Transaksi
            </h6>
        </div>
          <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('transaksi.add') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> REKAM TRANSAKSI</a>
                <button class="btn btn-primary btn-sm"><i class="fas fa-trash"></i> HAPUS</button>
                <button class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> EXCEL</button>
            </div>
            <div class="d-flex align-items-center mb-2">
                <span class="mr-2">View</span>
                <select class="form-control form-control-sm mr-3" style="width: 70px;">
                    <option>50</option>
                    <option>100</option>
                    <option>200</option>
                </select>
                <span class="mr-2 font-weight-bold text-primary">Cari Transaksi</span>
                <input type="text" class="form-control form-control-sm" style="width: 250px;" placeholder="Uraian || No. Bukti || Tanggal (yyyy-mm-dd)" disabled>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Edit</th>
                            <th>No. Bukti <span class="text-danger">&#8597;</span></th>
                            <th>Tanggal <span class="text-danger">&#8597;</span></th>
                            <th>Uraian</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Jns Transaksi <span class="text-danger">&#8597;</span></th>
                            <th>Akun</th>
                            <th>Kuitansi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($transaksi as $item)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> EDIT
                                </a>
                            </td>
                            <td>{{ $item->no_bukti }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->uraian }}</td>
                            <td>{{ number_format($item->debet,0,',','.') }}</td>
                            <td>{{ number_format($item->kredit,0,',','.') }}</td>
                            <td>{{ $item->jenis_transaksi }}</td>
                            <td>{{ $item->akun }}</td>
                            <td>
                                <a href="{{ route('transaksi.cetak', $item->id_transaksi) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-print"></i> CETAK
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <span>Record : {{ count($transaksi) }}</span>
            </div>
            <div>
                {{-- Contoh pagination --}}
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        {{-- Tambahkan halaman lain jika ada --}}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection