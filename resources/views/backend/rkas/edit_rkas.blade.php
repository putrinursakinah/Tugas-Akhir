@extends('admin.admin_master')
@section('title', 'Edit Detail Akun')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width: 1100px; margin: auto;">
        <div class="card-header py-2 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-file-alt"></i> Edit Detail Akun
            </h6>
        </div>
        <div class="card-body" style="background: #f8f9fc;">
            <form action="{{ route('rkas.update', $detail->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <b>KATEGORI</b> :
                            <span class="font-weight-bold">{{ $kategori->uraian ?? '-' }}</span>
                        </div>
                        <div class="col-md-3">
                            <b>KEGIATAN</b> :
                            <span class="font-weight-bold">{{ $kegiatan->uraian ?? '-' }}</span>
                        </div>
                        <div class="col-md-3">
                            <b>KOMPONEN</b> :
                            <span class="font-weight-bold">{{ $komponen->uraian ?? '-' }}</span>
                        </div>
                        <div class="col-md-3">
                            <b>AKUN</b> :
                            <span class="font-weight-bold">{{ $akun->uraian ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-end mb-2">
                    <div class="col-md-3">
                        <label class="font-weight-bold">Kode Detail</label>
                        <div class="input-group">
                            <input type="text" class="form-control"
                                name="kode_detail"
                                value="{{
                                        ($kategori ? $kategori->kode_akun : '') . '.' .
                                        ($kegiatan ? $kegiatan->kode_akun : '') . '.' .
                                        ($komponen ? $komponen->kode_akun : '') . '.' .
                                        ($akun ? $akun->kode_akun : '')
                             }}"
                                readonly>
                            <input type="number" class="form-control" name="kode_urut" placeholder="2" min="1" max="999" value="{{ $detail->kode_urut }}" required>
                        </div>
                        <small class="text-muted">
                            Kode Detail digunakan untuk Kodifikasi Pembeda antara satu Detail dengan Detail lainnya dalam satu akun. Dapat berupa urut urut angka 1 - 999.
                        </small>
                    </div>
                </div>
                <div class="form-row mb-2">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Uraian Detail</label>
                        <input type="text" class="form-control" name="uraian_detail" value="{{ $detail->uraian }}" placeholder="Uraian Detail">
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Jumlah Anggaran</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="number" step="any" class="form-control mb-1" id="total_vol" name="vol" value="{{ $detail->vol }}" placeholder="Total Vol">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control mb-1" name="satuan" value="{{ $detail->satuan }}" placeholder="Satuan">
                            </div>
                            <div class="col">
                                <input type="number" step="any" class="form-control mb-1" id="harga_satuan" name="harga_satuan" value="{{ $detail->harga_satuan }}" placeholder="Harga Satuan">
                            </div>
                            <div class="col">
                                <input type="number" step="any" class="form-control mb-1" id="total" name="jumlah" value="{{ $detail->jumlah }}" placeholder="Total" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Sumber Pembiayaan</label>
                            <select class="form-control" name="sumber_pembiayaan"
                                @if(
                                !($kategori && ((isset($kategori->uraian) && stripos(strtolower($kategori->uraian), 'belanja') !== false)
                                || (isset($kategori->kode_akun) && strtoupper(substr($kategori->kode_akun, 0, 1)) === 'B')
                                ))
                                )
                                disabled
                                @endif
                                >
                                <option>-- Khusus untuk Akun Belanja--</option>
                                {{-- Tambahkan opsi lain jika perlu --}}
                            </select>
                            <small class="text-muted">
                                Sumber Pembiayaan adalah Akun Pendapatan yang akan digunakan untuk membiayai Kegiatan ini. <b>Khusus untuk Rencana Belanja</b>
                            </small>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                                <i class="fas fa-save"></i> SIMPAN
                            </button>
                            <a href="{{ route('rkas.view') }}" class="btn btn-info btn-sm font-weight-bold">
                                <i class="fas fa-times"></i> BATAL
                            </a>
                        </div>
                    </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function hitungTotal() {
                        let vol = parseFloat(document.getElementById('total_vol').value) || 0;
                        let harga = parseFloat(document.getElementById('harga_satuan').value) || 0;
                        document.getElementById('total').value = vol * harga;
                    }

                    document.getElementById('total_vol').addEventListener('input', hitungTotal);
                    document.getElementById('harga_satuan').addEventListener('input', hitungTotal);
                });
            </script>
        </div>
    </div>
</div>
@endsection