@extends('admin.admin_master')
@section('title','Tambah Akun')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width:1100px; margin:auto;">
        <div class="card-header py-2 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-file-alt"></i> Tambah Akun
            </h6>
        </div>
        <div class="card-body" style="background:#f8f9fc;">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <b>KATEGORI</b> : <span class="font-weight-bold">
                            {{ strtolower($kategori ?? '') == 'belanja' ? 'B' : 'A' }} - {{ strtoupper($kategori ?? '') }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <b>KEGIATAN</b> : <span class="font-weight-bold">
                            {{ $kegiatan_kode ?? '' }} - {{ $kegiatan_nama ?? '' }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <b>KOMPONEN</b> : <span class="font-weight-bold">
                            {{ $komponen_kode ?? '' }} - {{ $komponen_nama ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
            <form action="{{ route('rkas.akunStore', $komponen_id ?? 0) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold mb-2">
                    <i class="fas fa-user-plus"></i> TAMBAHKAN AKUN KE KOMPONEN {{ $komponen_kode ?? '' }}
                </button>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" placeholder="Cari Data" id="searchAkun">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Kode Akun</th>
                                <th>Uraian</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody id="akunTable">
                            @foreach($daftar_akun as $akun)
                            <tr>
                                <td><input type="checkbox" name="akun_ids[]" value="{{ $akun->id }}"></td>
                                <td>{{ $akun->kode }}</td>
                                <td>{{ $akun->uraian ?? $akun->kegiatan }}</td>
                                <td>{{ strtolower($akun->kategori) == 'belanja' ? 'B' : 'A' }} - {{ ucfirst($akun->kategori) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script filter pencarian dan check all --}}
<script>
    document.getElementById('searchAkun').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#akunTable tr');
        rows.forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
    document.getElementById('checkAll').addEventListener('change', function() {
        var checked = this.checked;
        document.querySelectorAll('input[name="akun_ids[]"]').forEach(function(cb) {
            cb.checked = checked;
        });
    });
</script>
@endsection