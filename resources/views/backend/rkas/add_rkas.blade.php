@extends('admin.admin_master')
@section('title','Tambah Kegiatan')
@section('admin')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow" style="border-radius:12px;">
                <div class="card-header bg-primary text-white" style="border-radius:12px 12px 0 0;">
                    <h4 class="mb-0" style="font-family:monospace; font-weight:bold;">
                        <i class="fas fa-plus-square"></i> TAMBAH DATA RKAS
                    </h4>
                </div>
                <form action="{{ route('rkas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        {{-- Kegiatan --}}
                        <div class="form-group mb-3">
                            <label for="kegiatan">Pilih Kegiatan</label>
                            <select name="kegiatan_id" id="kegiatan" class="form-control" required>
                                <option value="">--Pilih Kegiatan--</option>
                                @foreach ($kegiatan as $item)
                                <option value="{{ $item->id_kegiatan }}">{{ $item->kode }} - {{ $item->kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Komponen --}}
                        <div class="form-row mb-3">
                            <div class="col-md-3">
                                <label>Kode Komponen</label>
                                <input type="text" name="komponen_kode" class="form-control" required>
                            </div>
                            <div class="col-md-9">
                                <label>Uraian Komponen</label>
                                <input type="text" name="komponen_uraian" class="form-control" required>
                            </div>
                        </div>
                        {{-- Akun --}}
                        <div class="form-group mb-3">
                            <label>Pilih Akun</label>
                            <select name="akun_id" class="form-control" required>
                                <option value="">--Pilih Akun--</option>
                                @foreach ($kodeAkun as $akun)
                                <option value="{{ $akun->id_akun }}">{{ $akun->kode }} - {{ $akun->kegiatan }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-row mb-3">
                                <label>Uraian Detail</label>
                                <input type="text" name="detail_uraian" id="detail_uraian" class="form-control" required>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <label>Vol</label>
                                    <input type="number" name="detail_vol" id="detail_vol" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Satuan</label>
                                    <input type="text" name="detail_satuan" id="detail_satuan" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Harga Satuan</label>
                                    <input type="number" name="detail_harga_satuan" id="detail_harga_satuan" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Jumlah</label>
                                    <input type="number" name="detail_jumlah" id="detail_jumlah" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between" style="border-radius:0 0 12px 12px;">
                            <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                                <i class="far fa-check-square"></i> SIMPAN SEMUA DATA
                            </button>
                            <a href="{{ route('rkas.view', ['kategori_id' => $kategori->id_kategori]) }}" class="btn btn-dark btn-sm" style="border-radius:12px; font-family:monospace;">
                                CLOSE
                            </a>
                        </div>
                </form>
            </div>
        </div>
        <script>
            // Ambil elemen input
            const volInput = document.getElementById('detail_vol');
            const hargaInput = document.getElementById('detail_harga_satuan');
            const jumlahInput = document.getElementById('detail_jumlah');

            // Fungsi untuk menghitung jumlah
            function hitungJumlah() {
                const vol = parseFloat(volInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = vol * harga;
                jumlahInput.value = jumlah;
            }

            // Event listener untuk input vol dan harga satuan
            volInput.addEventListener('input', hitungJumlah);
            hargaInput.addEventListener('input', hitungJumlah);
        </script>
    </div>
</div>

@endsection