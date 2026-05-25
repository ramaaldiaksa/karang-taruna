@extends('layouts.public')

@section('content')
<div class="container py-5 mt-3 mb-5">
    <!-- Header Section -->
    <div class="row align-items-end mb-4 pb-2">
        <div class="col-md-8">
            <h2 class="text-primary fw-semibold mb-2" style="font-size: 1.5rem;">Laporan Keuangan</h2>
            <p class="text-muted mb-0" style="font-size: 1rem;">Transparansi dan akuntabilitas pengelolaan dana Karang Taruna Rimba Ketapan. Pantau arus kas masuk dan keluar secara real-time.</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background-color: #1a3a8a;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-white-50 fw-semibold">Total Saldo Kas</p>
                        <h3 class="fw-bold mb-0">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background-color: #1a7a3a;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="fas fa-piggy-bank fa-2x"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-white-50 fw-semibold">Total Pemasukan</p>
                        <h4 class="fw-bold mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background-color: #b91c1c;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-white-50 fw-semibold">Total Pengeluaran</p>
                        <h4 class="fw-bold mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Transactions Section -->
        <div class="col-lg-12">
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
