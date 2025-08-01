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
            {{-- FORM HAPUS --}}
            <form action="{{ route('transaksi.delete-selected') }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <a href="{{ route('transaksi.add') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> REKAM TRANSAKSI
                    </a>

                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
                        <i class="fas fa-trash"></i> HAPUS
                    </button>

                    <a href="{{ route('transaksi.export') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> EXCEL
                    </a>
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
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Edit</th>
                                <th>Tanggal <span class="text-danger">&#8597;</span></th>
                                <th>Uraian</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $item->id_transaksi ?? $item->id }}">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> EDIT
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->uraian }}</td>
                                <td>{{ number_format($item->debet,0,',','.') }}</td>
                                <td>{{ number_format($item->kredit,0,',','.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <span>Record : {{ count($transaksi) }}</span>
                </div>

                <div>
                    <nav>
                        <ul class="pagination pagination-sm">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    function confirmDelete() {
        const checked = document.querySelectorAll('input[name="ids[]"]:checked');
        if (checked.length === 0) {
            alert('Pilih minimal satu transaksi untuk dihapus.');
            return;
        }
        if (confirm('Yakin ingin menghapus data yang dipilih?')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Select All
    document.getElementById('checkAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

@endsection