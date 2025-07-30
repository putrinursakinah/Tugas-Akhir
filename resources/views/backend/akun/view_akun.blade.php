@extends('admin.admin_master')
@section('title','Kode Akun')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> Daftar Kode Akun
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('akun.bulkDelete') }}" method="POST" id="bulkDeleteForm">
                @csrf
                @method('DELETE')

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Edit</th>
                                <th>Kode</th>
                                <th>Kegiatan</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($akun as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $item->id_akun }}">
                                </td>
                                <td>
                                    <a href="{{ route('akun.edit', $item->id_akun) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> EDIT
                                    </a>
                                </td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->kegiatan }}</td>
                                <td>
                                    @php
                                    $kategori = '-';
                                    $kode = intval($item->kode);
                                    if ($kode >= 100000 && $kode <= 199999) {
                                        $kategori='Pendapatan' ;
                                        } elseif ($kode>= 200000 && $kode <= 299999) {
                                            $kategori='Belanja' ;
                                            }
                                            echo $kategori;
                                            @endphp
                                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <a href="{{ route('akun.add') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> TAMBAH
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">
                        <i class="fas fa-trash"></i> HAPUS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Check All --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = checkAll.checked);
        });
    });
</script>

@endsection