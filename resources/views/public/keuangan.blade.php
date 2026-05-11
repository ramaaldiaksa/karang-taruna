@extends('layouts.public')

@section('content')
<div class="container py-5 mt-3 mb-5">
    <!-- Header Section -->
    <div class="row align-items-end mb-4 pb-2">
        <div class="col-md-8">
            <h2 class="text-primary fw-semibold mb-2" style="font-size: 1.5rem;">Laporan Keuangan</h2>
            <p class="text-muted mb-0" style="font-size: 1rem;">Transparansi tata kelola dana organisasi untuk mewujudkan akuntabilitas dan integritas desa yang berkelanjutan.</p>
        </div>
        <div class="col-md-4 text-md-end mt-4 mt-md-0">
            <button class="btn btn-outline-secondary px-3 py-2 fw-medium me-2 shadow-sm bg-white" style="border-radius: 6px; border-color: #dee2e6;">
                <i class="fas fa-download me-1 text-muted"></i> PDF
            </button>
            <button class="btn btn-outline-secondary px-3 py-2 fw-medium shadow-sm bg-white" style="border-radius: 6px; border-color: #dee2e6;">
                <i class="far fa-file-excel me-1 text-muted"></i> Excel
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 bg-primary text-white border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4 position-relative">
                    <h6 class="fw-semibold tracking-wider mb-4 text-white-50" style="letter-spacing: 1px; font-size: 0.85rem;">SALDO KAS SAAT INI</h6>
                    <h3 class="fw-bold mb-4">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                    <div class="d-flex align-items-center text-white" style="font-size: 0.9rem;">
                        <i class="fas fa-chart-line me-2"></i> <span class="fw-medium">+12% dari bulan lalu</span>
                    </div>
                    <div class="position-absolute" style="top: 1.5rem; right: 1.5rem;">
                        <i class="fas fa-wallet fa-2x text-white-50 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 bg-white border shadow-sm" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                <div class="card-body p-4 position-relative">
                    <h6 class="text-muted fw-semibold tracking-wider mb-4" style="letter-spacing: 1px; font-size: 0.85rem;">TOTAL PEMASUKAN</h6>
                    <h3 class="text-dark fw-bold mb-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                    <div class="text-muted" style="font-size: 0.9rem;">
                        Periode: {{ date('F Y') }}
                    </div>
                    <div class="position-absolute" style="top: 1.5rem; right: 1.5rem;">
                        <i class="fas fa-arrow-down text-primary fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 bg-white border shadow-sm" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                <div class="card-body p-4 position-relative">
                    <h6 class="text-muted fw-semibold tracking-wider mb-4" style="letter-spacing: 1px; font-size: 0.85rem;">TOTAL PENGELUARAN</h6>
                    <h3 class="text-dark fw-bold mb-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                    <div class="text-muted" style="font-size: 0.9rem;">
                        Periode: {{ date('F Y') }}
                    </div>
                    <div class="position-absolute" style="top: 1.5rem; right: 1.5rem;">
                        <i class="fas fa-arrow-up text-danger fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart Section -->
        <div class="col-lg-4">
            <div class="card h-100 border shadow-sm" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                <div class="card-body p-4 d-flex flex-column">
                    <h6 class="text-dark fw-semibold mb-4">Arus Kas Bulanan</h6>
                    
                    <!-- Chart Placeholder -->
                    <div class="flex-grow-1 d-flex flex-column justify-content-end mb-4" style="min-height: 200px;">
                        <div class="d-flex justify-content-between align-items-end h-100 px-2 pb-3 border-bottom">
                            <!-- Dummy Bars -->
                            <div class="bg-light rounded-top w-100 mx-1" style="height: 30%;"></div>
                            <div class="bg-light rounded-top w-100 mx-1" style="height: 40%;"></div>
                            <div class="bg-light rounded-top w-100 mx-1" style="height: 25%;"></div>
                            <div class="bg-light rounded-top w-100 mx-1" style="height: 60%;"></div>
                            <div class="bg-light rounded-top w-100 mx-1" style="height: 45%;"></div>
                            <div class="bg-primary rounded-top w-100 mx-1" style="height: 80%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-muted mt-2" style="font-size: 0.7rem; font-weight: 600;">
                            <span>MEI</span><span>JUN</span><span>JUL</span><span>AGU</span><span>SEP</span><span class="text-primary">OKT</span>
                        </div>
                    </div>

                    <!-- Info Alert -->
                    <div class="alert bg-light-gray border-0 d-flex align-items-start mt-auto mb-0" style="border-radius: 8px;">
                        <i class="fas fa-info-circle text-primary mt-1 me-2"></i>
                        <p class="text-muted small mb-0" style="line-height: 1.5;">Peningkatan arus kas signifikan pada bulan Agustus dan Oktober sehubungan dengan iuran tahunan dan sponsor festival desa.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Section -->
        <div class="col-lg-8">
            <div class="card h-100 border shadow-sm" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                    <h6 class="text-dark fw-semibold mb-0">Riwayat Transaksi</h6>
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted small"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari transaksi..." style="box-shadow: none; font-size: 0.9rem;">
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="bg-light-gray text-muted" style="font-size: 0.85rem;">
                                <tr>
                                    <th class="ps-4 py-3 fw-semibold border-bottom">Tanggal</th>
                                    <th class="py-3 fw-semibold border-bottom">Keterangan</th>
                                    <th class="py-3 fw-semibold border-bottom">Jenis</th>
                                    <th class="text-end pe-4 py-3 fw-semibold border-bottom">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($keuangan as $trx)
                                <tr class="border-bottom">
                                    <td class="ps-4 py-3 text-dark fw-medium" style="font-size: 0.95rem;">{{ \Carbon\Carbon::parse($trx->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td class="py-3 text-muted" style="font-size: 0.95rem;">{{ $trx->keterangan ?? '-' }}</td>
                                    <td class="py-3">
                                        @if($trx->jenis_transaksi == 'pemasukan')
                                            <span class="badge bg-light-blue text-primary px-2 py-1 fw-semibold" style="border-radius: 4px; font-size: 0.75rem; letter-spacing: 0.5px;">PEMASUKAN</span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 fw-semibold" style="border-radius: 4px; font-size: 0.75rem; letter-spacing: 0.5px;">PENGELUARAN</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4 py-3 fw-bold text-{{ $trx->jenis_transaksi == 'pemasukan' ? 'primary' : 'danger' }}" style="font-size: 0.95rem;">
                                        {{ $trx->jenis_transaksi == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Belum ada data transaksi keuangan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @if($keuangan->count() > 0)
                <div class="card-footer bg-white border-top text-center py-3">
                    <a href="#" class="text-primary fw-medium text-decoration-none" style="font-size: 0.9rem;">Lihat Seluruh Transaksi</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
