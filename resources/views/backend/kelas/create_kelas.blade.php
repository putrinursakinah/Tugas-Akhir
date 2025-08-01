@extends('admin.admin_master')
@section('title', 'Tambah Peserta')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Tambah Peserta ke Kelas: {{ $kelas->nama_kelas }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.peserta.simpan', $kelas->id_kelas) }}" method="POST">
                @csrf

                <!-- Dropdown Tahun Angkatan -->
                <div class="mb-3">
                    <label for="angkatan" class="form-label">Tahun Angkatan</label>
                    <select name="angkatan" id="angkatan" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($angkatanList as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Daftar siswa berdasarkan angkatan -->
                <div id="siswa-container" class="mb-3" style="display: none;">
                    <label class="form-label">Pilih Siswa</label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Pilih</th>
                                </tr>
                            </thead>
                            <tbody id="siswa-table-body">
                                {{-- Baris siswa akan dimasukkan di sini lewat JavaScript --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Peserta</button>
                <a href="{{ route('kelas.peserta', $kelas->id_kelas) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const angkatanSelect = document.getElementById('angkatan');
        const siswaContainer = document.getElementById('siswa-container');
        const siswaTableBody = document.getElementById('siswa-table-body');

        angkatanSelect.addEventListener('change', function() {
            const angkatan = this.value;
            siswaTableBody.innerHTML = ''; // Kosongkan isi tabel

            if (angkatan) {
                alert(angkatan);
                fetch(`/kelas/api/siswa-by-angkatan/${angkatan}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            siswaContainer.style.display = 'block';
                            siswaTableBody.innerHTML = `
                                <tr>
                                    <td colspan="5" class="text-danger text-center">Tidak ada siswa untuk angkatan ini.</td>
                                </tr>`;
                        } else {
                            siswaContainer.style.display = 'block';
                            data.forEach((siswa, index) => {
                                siswaTableBody.innerHTML += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${siswa.nama}</td>
                                        <td>${siswa.nisn}</td>
                                        <td>${siswa.alamat}</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="siswa_ids[]" value="${siswa.id_siswa}">
                                        </td>
                                    </tr>
                                `;
                            });
                        }
                    })
                    .catch(error => {
                        siswaContainer.style.display = 'block';
                        siswaTableBody.innerHTML = `
                            <tr>
                                <td colspan="5" class="text-danger text-center">Gagal mengambil data siswa.</td>
                            </tr>`;
                        console.error('Fetch error:', error);
                    });
            } else {
                siswaContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection