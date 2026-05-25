@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <style>
        .dashboard-full {
            display: block;
        }

        .dashboard-full .row.mb-4.g-3 {
            margin-bottom: 0.75rem;
        }

        .summary-card {
            min-height: 110px;
            border-radius: 10px;
        }

        .dashboard-full .charts-row {
            flex-wrap: nowrap;
            align-items: stretch;
        }

        .dashboard-full .charts-row>[class*="col-lg-"] {
            display: flex;
        }

        .main-card {
            height: 430px;
            width: 100%;
        }

        .trend-card-body {
            padding: 1.35rem 1.25rem 1.15rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .trend-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f2f6b;
            letter-spacing: -0.01em;
        }

        .trend-icon {
            color: #a9b4c9;
            font-size: 1.2rem;
        }

        .trend-badge {
            font-size: 0.68rem;
            font-weight: 600;
            border-radius: 0.3rem;
            padding: 0.22rem 0.55rem;
            color: #5e6f8d;
            background: #f4f7fc;
            border: 1px solid #d5deea;
        }

        .chart-container {
            width: 100%;
            display: flex;
            align-items: stretch;
            flex: 1;
            min-height: 0;
        }

        .chart-container canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .stats-content {
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .stats-card-body {
            padding: 1.35rem 1.25rem 1.15rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .stats-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f2f6b;
            letter-spacing: -0.01em;
        }

        .stats-icon {
            color: #a9b4c9;
            font-size: 1.2rem;
        }

        .stats-block {
            margin-bottom: 1.15rem;
        }

        .stats-label {
            font-size: 0.68rem;
            letter-spacing: 1.1px;
            font-weight: 700;
            color: #5e6f8d;
            margin-bottom: 0.25rem;
        }

        .stats-amount {
            font-size: 1.1rem;
            line-height: 1.05;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .stats-progress {
            height: 6px;
            border-radius: 999px;
            background: #dfe7f4;
            overflow: hidden;
        }

        .stats-progress .progress-bar {
            border-radius: 999px;
        }

        .stats-summary-box {
            background: #f6f8fc;
            border: 1px solid #d5deea;
            border-radius: 0.8rem;
            padding: 0.8rem 0.9rem 0.75rem;
        }

        .stats-summary-label {
            font-size: 0.68rem;
            letter-spacing: 1.1px;
            font-weight: 700;
            color: #6b7890;
            margin-bottom: 0.25rem;
        }

        .stats-summary-amount {
            font-size: 1.55rem;
            line-height: 1;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #0f2f6b;
        }

        .stats-summary-currency {
            font-size: 0.72rem;
            color: #8b95a7;
            font-weight: 500;
            margin-left: 0.2rem;
        }

        .stats-action {
            background: #0b2e72;
            color: #fff;
            border: none;
            font-weight: 600;
            border-radius: 0.6rem;
            padding: 0.78rem 0.95rem;
            box-shadow: 0 10px 20px rgba(11, 46, 114, 0.2);
        }

        .stats-action {
            margin-top: auto;
        }

        .surat-card-body {
            padding: 1.35rem 1.25rem 1.15rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .surat-card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f2f6b;
            letter-spacing: -0.01em;
        }

        .surat-icon {
            color: #a9b4c9;
            font-size: 1.2rem;
        }

        .surat-total-box {
            background: #f6f8fc;
            border: 1px solid #d5deea;
            border-radius: 0.85rem;
            padding: 0.9rem 1rem;
            margin-bottom: 1rem;
        }

        .surat-total-label {
            font-size: 0.68rem;
            letter-spacing: 1.1px;
            font-weight: 700;
            color: #6b7890;
            margin-bottom: 0.25rem;
        }

        .surat-total-amount {
            font-size: 1.8rem;
            line-height: 1;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #0f2f6b;
        }

        .surat-chart-wrap {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
        }

        .surat-chart-wrap canvas {
            width: 100% !important;
            height: 100% !important;
            max-width: 260px;
            max-height: 260px;
        }

        .surat-legend {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .surat-legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .surat-legend-left {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            min-width: 0;
        }

        .surat-legend-dot {
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 999px;
            flex: 0 0 auto;
        }

        .surat-legend-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: #51617f;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .surat-legend-count {
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f2f6b;
            white-space: nowrap;
        }
    </style>

    <div class="dashboard-full" id="dashboardFull">
        <!-- Summary Cards -->
        <div class="row mb-4 g-3">
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 text-white h-150 summary-card" style="background: #1a3a8a;">
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 text-uppercase fw-bold"
                                    style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Verifikasi Peminjaman</p>
                                <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $peminjamanMenunggu }}</h2>
                            </div>
                            <i class="fas fa-handshake fa-2x" style="opacity: 0.3;"></i>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0" style="background: transparent;">
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="text-white text-decoration-none small fw-medium">Verifikasi Sekarang<i
                                class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 text-white h-150 summary-card" style="background: #e6a817;">
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 text-uppercase fw-bold"
                                    style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Verifikasi Pengembalian</p>
                                <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $peminjamanBelumKembali }}</h2>
                            </div>
                            <i class="fas fa-hourglass-half fa-2x" style="opacity: 0.3;"></i>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0" style="background: transparent;">
                        <a href="{{ route('admin.pengembalian.index') }}"
                            class="text-white text-decoration-none small fw-medium">Verifikasi Sekarang <i
                                class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 text-white h-100 summary-card" style="background: #1a7a3a;">
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 text-uppercase fw-bold"
                                    style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Total Inventaris</p>
                                <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $totalInventaris }}</h2>
                            </div>
                            <i class="fas fa-boxes fa-2x" style="opacity: 0.3;"></i>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0" style="background: transparent;">
                        <a href="{{ route('admin.inventaris.index') }}"
                            class="text-white text-decoration-none small fw-medium">Lihat Detail <i
                                class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 text-white h-100 summary-card" style="background: #b91c1c;">
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 text-uppercase fw-bold"
                                    style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Transaksi Keuangan</p>
                                <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $totalKeuangan }}</h2>
                            </div>
                            <i class="fas fa-money-bill-wave fa-2x" style="opacity: 0.3;"></i>
                        </div>
                    </div>
                    <div class="card-footer border-0 pt-0" style="background: transparent;">
                        <a href="{{ route('admin.keuangan.index') }}"
                            class="text-white text-decoration-none small fw-medium">Lihat Detail <i
                                class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4 g-3 charts-row">
            <!-- Tren Peminjaman Bulanan -->
            <div class="col-lg-6">
                <div class="card border main-card" style="border-radius: 10px; border-color: #e5e7eb !important;">
                    <div class="card-body trend-card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <h6 class="trend-card-title mb-0">Tren Peminjaman Bulanan</h6>
                            <i class="fas fa-chart-line trend-icon"></i>
                        </div>

                        <div class="chart-container mt-1">
                            <canvas id="trenPeminjamanChart"
                                style="width:100% !important; height:100% !important;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistik Keuangan -->
            <div class="col-lg-3">
                <div class="card border main-card" style="border-radius: 10px; border-color: #e5e7eb !important;">
                    <div class="card-body stats-card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <h6 class="stats-card-title mb-0">Laporan Keuangan</h6>
                            <i class="fas fa-money-bill-wave stats-icon"></i>
                        </div>

                        <div class="stats-content">
                            @php
                                $totalTransaksiKeuangan = $totalPemasukan + $totalPengeluaran;
                                $persentasePemasukan =
                                    $totalTransaksiKeuangan > 0
                                        ? round(($totalPemasukan / $totalTransaksiKeuangan) * 100)
                                        : 0;
                                $persentasePengeluaran =
                                    $totalTransaksiKeuangan > 0
                                        ? round(($totalPengeluaran / $totalTransaksiKeuangan) * 100)
                                        : 0;
                            @endphp

                            <div class="stats-block">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="stats-label mb-0">PEMASUKAN</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <span class="stats-amount text-success">Rp
                                        {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                                </div>
                                <div class="progress stats-progress">
                                    <div class="progress-bar bg-success" style="width: {{ $persentasePemasukan }}%;"></div>
                                </div>
                            </div>

                            <div class="stats-block">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="stats-label mb-0">PENGELUARAN</span>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <span class="stats-amount text-danger">Rp
                                        {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                                </div>
                                <div class="progress stats-progress">
                                    <div class="progress-bar bg-danger" style="width: {{ $persentasePengeluaran }}%;">
                                    </div>
                                </div>
                            </div>

                            <div class="stats-summary-box mb-4">
                                <div class="stats-summary-label text-uppercase">Saldo Akhir Saat Ini</div>
                                <div class="d-flex align-items-end flex-wrap">
                                    <span class="stats-summary-amount">Rp
                                        {{ number_format($saldoAkhir, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('admin.keuangan.index') }}" class="btn stats-action w-100 mt-auto">
                                <i class="fas fa-wallet me-2"></i> Kelola Keuangan <i
                                    class="fas fa-chevron-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Diagram Surat -->
            <div class="col-lg-3 d-flex">
                <div class="card border main-card"
                    style="border-radius: 10px; border-color: #e5e7eb !important; width:100%;">
                    <div class="card-body surat-card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="surat-card-title mb-0">Arsip Surat</h6>
                            <i class="fas fa-envelope-open-text surat-icon"></i>
                        </div>

                        <div class="surat-chart-wrap">
                            <canvas id="suratChart"></canvas>
                        </div>

                        <div class="surat-legend">
                            <div class="surat-legend-item">
                                <div class="surat-legend-left">
                                    <span class="surat-legend-dot" style="background: #1a3a8a;"></span>
                                    <span class="surat-legend-label">Surat Masuk</span>
                                </div>
                                <span class="surat-legend-count">{{ $totalSuratMasuk }}</span>
                            </div>
                            <div class="surat-legend-item">
                                <div class="surat-legend-left">
                                    <span class="surat-legend-dot" style="background: #e6a817;"></span>
                                    <span class="surat-legend-label">Surat Keluar</span>
                                </div>
                                <span class="surat-legend-count">{{ $totalSuratKeluar }}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <span class="stats-label mb-0"></span>
                        </div>

                        <div class="surat-total-box">
                            <div class="surat-total-label text-uppercase">Total Jumlah Surat</div>
                            <div class="surat-total-amount">{{ $totalSurat }}</div>
                        </div>

                        <a href="{{ route('admin.surat.index') }}" class="btn stats-action w-100 mt-auto">
                            <i class="fas fa-archive me-2"></i> Arsip Surat <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- end .dashboard-full -->
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tren Peminjaman Bulanan - Bar Chart
                const trenEl = document.getElementById('trenPeminjamanChart');
                if (trenEl) {
                    const trenCtx = trenEl.getContext('2d');
                    new Chart(trenCtx, {
                        type: 'bar',
                        data: {
                            labels: @json($trenPeminjamanLabels),
                            datasets: [{
                                data: @json($trenPeminjaman),
                                backgroundColor: function(context) {
                                    const index = context.dataIndex;
                                    const value = context.dataset.data[index];
                                    const max = Math.max(...context.dataset.data);
                                    return value === max ? '#1a3a8a' : '#c7d7f5';
                                },
                                borderRadius: 4,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 10,
                                        font: {
                                            size: 10
                                        }
                                    },
                                    grid: {
                                        color: '#f3f4f6'
                                    }
                                },
                                x: {
                                    ticks: {
                                        font: function(context) {
                                            const index = context.index;
                                            const data = context.chart.data.datasets[0].data;
                                            const max = Math.max(...data);
                                            return {
                                                size: 10,
                                                weight: data[index] === max ? 'bold' : 'normal'
                                            };
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }

                // Diagram Surat Masuk/Keluar - Doughnut Chart
                const suratEl = document.getElementById('suratChart');
                if (suratEl) {
                    const suratCtx = suratEl.getContext('2d');
                    new Chart(suratCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Surat Masuk', 'Surat Keluar'],
                            datasets: [{
                                data: @json([$totalSuratMasuk, $totalSuratKeluar]),
                                backgroundColor: ['#1a3a8a', '#e6a817'],
                                borderColor: '#ffffff',
                                borderWidth: 2,
                                hoverOffset: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return ' ' + context.label + ': ' + context.parsed;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // Keep default page flow for consistent layout
            });
        </script>
    @endpush
