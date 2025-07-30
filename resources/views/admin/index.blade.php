@extends('admin.admin_master')
@section('admin')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Rencana Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rencana Pendapatan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp {{ number_format($rencanaPendapatan, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-muted">Target yang direncanakan</div>
                </div>
            </div>
        </div>

        <!-- Realisasi Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Realisasi Pendapatan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp {{ number_format($realisasiPendapatan, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-muted">Total yang sudah diterima</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Rencana Belanja</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp {{ number_format($rencanaBelanja, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-muted">Target pengeluaran yang direncanakan</div>
                </div>
            </div>
        </div>

        <!-- Realisasi Belanja -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Realisasi Belanja</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp {{ number_format($realisasiBelanja, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-muted">Total pengeluaran saat ini</div>
                </div>
            </div>
        </div>

        <!-- Persentase Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Persentase Pendapatan</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ round($persenPendapatan, 2) }}%
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: {{ round($persenPendapatan, 2) }}%;"
                                    aria-valuenow="{{ round($persenPendapatan, 2) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-muted">Progress pencapaian</div>
                </div>
            </div>
        </div>

        <!-- Persentase Belanja -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Persentase Belanja</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ round($persenBelanja, 2) }}%
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ round($persenBelanja, 2) }}%;"
                                    aria-valuenow="{{ round($persenBelanja, 2) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-muted">Progress penggunaan anggaran</div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection