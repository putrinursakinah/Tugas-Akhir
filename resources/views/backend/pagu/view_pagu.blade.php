@extends('admin.admin_master')
@section('title','Mapping Pagu ke SPP')
@section('admin')

<div class="container-fluid">
    <h4 class="mb-4">Daftar Data Anggaran (Kategori: Pendapatan)</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paguSpp as $index => $spp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $spp->anggaran->uraian }}</td>
                            <td>{{ number_format($spp->anggaran->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <!-- Kosongkan atau beri tombol hapus jika perlu -->
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <form action="{{ route('pagu-spp.store') }}" method="POST">
                                @csrf
                                <td>#</td>
                                <td colspan="2">
                                    <select name="id_anggaran" class="form-control" required>
                                        <option value="">-- Pilih Data RKAS Pendapatan --</option>
                                        @foreach($dataAnggaran as $item)
                                        <option value="{{ $item->id_anggaran }}">{{ $item->uraian }} ({{ number_format($item->jumlah, 0, ',', '.') }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success" type="submit">Tambah</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection