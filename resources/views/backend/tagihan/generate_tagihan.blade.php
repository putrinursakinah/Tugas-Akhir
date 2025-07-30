@extends('admin.admin_master')
@section('title', 'Generate Tagihan')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-sync"></i> Generate Tagihan Siswa
            </h6>
        </div>

        <div class="card-body">
            <p>
                Halaman ini digunakan untuk melakukan generate tagihan untuk siswa.
                Silakan pilih jenis biaya, kelas, dan centang siswa yang akan digenerate.
            </p>

            <form action="{{ route('tagihan.generate') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jenis_biaya">Jenis Biaya</label>
                        <select name="jenis_biaya" id="jenis_biaya" class="form-control" required>
                            <option value="">-- Pilih Jenis Biaya --</option>
                            @foreach($jenisBiayaList as $biaya)
                            <option value="{{ $biaya->id_jenisbiaya }}">
                                {{ $biaya->nama }} (Rp {{ number_format($biaya->nominal, 0, ',', '.') }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Siswa akan dimuat di sini --}}
                <div id="siswa-container" class="mt-4"></div>

                <div class="form-group mt-4">
                    <a href="{{ route('tagihan.view') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync"></i> Proses Generate
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- Include jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#kelas').on('change', function() {
        let kelasId = $(this).val();

        if (kelasId) {
            $.ajax({
                url: `/tagihan/get-siswa-by-kelas/${kelasId}`,
                method: 'GET',
                success: function(response) {
                    let html = '';
                    if (response.length > 0) {
                        html += `
                        <label>Daftar Siswa</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th><input type="checkbox" id="checkAllAjax"></th>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        response.forEach(item => {
                            html += `
                                <tr>
                                    <td><input type="checkbox" name="siswa_ids[]" value="${item.id_kelashassiswa}"></td>
                                    <td>${item.siswa?.nama ?? '-'}</td>
                                    <td>${item.siswa?.nis ?? '-'}</td>
                                    <td>${item.kelas?.nama ?? '-'}</td>
                                </tr>
                            `;
                        });

                        html += `
                                </tbody>
                            </table>
                        </div>
                        `;
                    } else {
                        html = '<div class="alert alert-warning">Tidak ada siswa di kelas ini.</div>';
                    }

                    $('#siswa-container').html(html);

                    // Check All functionality
                    $(document).on('change', '#checkAllAjax', function() {
                        $('input[name="siswa_ids[]"]').prop('checked', this.checked);
                    });
                },
                error: function() {
                    $('#siswa-container').html('<div class="alert alert-danger">Gagal mengambil data siswa.</div>');
                }
            });
        } else {
            $('#siswa-container').html('');
        }
    });
</script>

@endsection