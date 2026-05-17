@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Summary Cards -->
<div class="row mb-4 g-3">
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 text-white h-100" style="background: #1a3a8a; border-radius: 10px;">
            <div class="card-body pb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Total Peminjaman</p>
                        <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $totalPeminjaman }}</h2>
                    </div>
                    <i class="fas fa-handshake fa-2x" style="opacity: 0.3;"></i>
                </div>
            </div>
            <div class="card-footer border-0 pt-0" style="background: transparent;">
                <a href="{{ route('admin.peminjaman.index') }}" class="text-white text-decoration-none small fw-medium">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 text-white h-100" style="background: #e6a817; border-radius: 10px;">
            <div class="card-body pb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Menunggu Verifikasi</p>
                        <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $peminjamanMenunggu }}</h2>
                    </div>
                    <i class="fas fa-clock fa-2x" style="opacity: 0.3;"></i>
                </div>
            </div>
            <div class="card-footer border-0 pt-0" style="background: transparent;">
                <a href="{{ route('admin.peminjaman.index') }}" class="text-white text-decoration-none small fw-medium">Verifikasi Sekarang <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 text-white h-100" style="background: #1a7a3a; border-radius: 10px;">
            <div class="card-body pb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Total Inventaris</p>
                        <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $totalInventaris }}</h2>
                    </div>
                    <i class="fas fa-boxes fa-2x" style="opacity: 0.3;"></i>
                </div>
            </div>
            <div class="card-footer border-0 pt-0" style="background: transparent;">
                <a href="{{ route('admin.inventaris.index') }}" class="text-white text-decoration-none small fw-medium">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 text-white h-100" style="background: #b91c1c; border-radius: 10px;">
            <div class="card-body pb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="mb-1 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; opacity: 0.9;">Transaksi Keuangan</p>
                        <h2 class="fw-bold mb-0" style="font-size: 2.2rem;">{{ $totalKeuangan }}</h2>
                    </div>
                    <i class="fas fa-money-bill-wave fa-2x" style="opacity: 0.3;"></i>
                </div>
            </div>
            <div class="card-footer border-0 pt-0" style="background: transparent;">
                <a href="{{ route('admin.keuangan.index') }}" class="text-white text-decoration-none small fw-medium">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4 g-3">
    <!-- Tren Peminjaman Bulanan -->
    <div class="col-lg-7">
        <div class="card border h-100" style="border-radius: 10px; border-color: #e5e7eb !important;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold text-primary mb-0" style="font-size: 0.85rem;">Tren Peminjaman Bulanan</h6>
                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.65rem;">Tahun {{ $tahunSekarang }}</span>
                </div>
                <div style="height: 180px;">
                    <canvas id="trenPeminjamanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Kategori Inventaris -->
    <div class="col-lg-5">
        <div class="card border h-100" style="border-radius: 10px; border-color: #e5e7eb !important;">
            <div class="card-body p-3">
                <h6 class="fw-bold text-primary mb-2" style="font-size: 0.85rem;">Kategori Inventaris</h6>
                <div class="d-flex align-items-center">
                    <div style="position: relative; width: 100px; height: 100px; flex-shrink: 0;">
                        <canvas id="kategoriChart"></canvas>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <span class="fw-bold" style="font-size: 0.95rem;">{{ $totalInventaris }}</span><br>
                            <small class="text-muted" style="font-size: 0.5rem;">TOTAL ITEM</small>
                        </div>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        @php
                            $colors = ['#1a3a8a', '#374151', '#9ca3af', '#f59e0b', '#10b981'];
                            $i = 0;
                        @endphp
                        @foreach($kategoriInventaris as $kategori => $jumlah)
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <span class="rounded-circle me-2" style="width: 8px; height: 8px; display: inline-block; background: {{ $colors[$i % count($colors)] }};"></span>
                                <span style="font-size: 0.75rem;">{{ $kategori }}</span>
                            </div>
                            <span class="badge bg-light text-dark border" style="font-size: 0.65rem; padding: 2px 6px;">{{ $jumlah }} ({{ $totalInventaris > 0 ? round($jumlah / $totalInventaris * 100) : 0 }}%)</span>
                        </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row -->
<div class="row g-3">
    <!-- Statistik Keuangan -->
    <div class="col-lg-4">
        <div class="card border h-100" style="border-radius: 10px; border-color: #e5e7eb !important;">
            <div class="card-body">
                <h6 class="fw-bold text-primary mb-4">Statistik Keuangan</h6>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size: 0.85rem;">Pemasukan</span>
                        <span class="fw-bold text-success" style="font-size: 0.85rem;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                    </div>
                    <div class="progress" style="height: 8px; border-radius: 4px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalPemasukan + $totalPengeluaran > 0 ? ($totalPemasukan / ($totalPemasukan + $totalPengeluaran) * 100) : 0 }}%; border-radius: 4px;"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size: 0.85rem;">Pengeluaran</span>
                        <span class="fw-bold text-danger" style="font-size: 0.85rem;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                    </div>
                    <div class="progress" style="height: 8px; border-radius: 4px;">
                        <div class="progress-bar bg-danger" style="width: {{ $totalPemasukan + $totalPengeluaran > 0 ? ($totalPengeluaran / ($totalPemasukan + $totalPengeluaran) * 100) : 0 }}%; border-radius: 4px;"></div>
                    </div>
                </div>

                <hr>
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Saldo Akhir</small>
                    <h4 class="fw-bold text-primary mb-0">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Terbaru -->
    <div class="col-lg-8">
        <div class="card border h-100" style="border-radius: 10px; border-color: #e5e7eb !important;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Peminjaman Terbaru</h6>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-outline-primary btn-sm" style="font-size: 0.8rem;">Download Laporan</a>
                </div>
                <x-admin.table-card>
                    <div class="table-responsive">
                        <table class="table admin-table">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Barang</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamanTerbaru as $p)
                                <tr>
                                    <td>{{ Str::limit($p->masyarakat->nama ?? '-', 20) }}</td>
                                    <td>
                                        @foreach($p->detail as $d)
                                            {{ $d->inventaris->nama_barang ?? '-' }} ({{ $d->jumlah_pinjam }}){{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($p->status == 'menunggu')
                                            <span class="admin-status-pill admin-status-pill--warning">Menunggu</span>
                                        @elseif($p->status == 'disetujui')
                                            <span class="admin-status-pill admin-status-pill--success">Disetujui</span>
                                        @elseif($p->status == 'ditolak')
                                            <span class="admin-status-pill admin-status-pill--danger">Ditolak</span>
                                        @else
                                            <span class="admin-status-pill admin-status-pill--success">Kembali</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <x-admin.icon-action :href="route('admin.peminjaman.verifikasi_form', $p->id_peminjaman)" variant="view" icon="fas fa-eye" title="Detail peminjaman" />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">Belum ada peminjaman terbaru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-admin.table-card>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <small class="text-muted">Menampilkan data terbaru</small>
                    <a href="{{ route('admin.peminjaman.index') }}" class="text-decoration-none fw-semibold" style="font-size: 0.85rem;">Semua Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Tren Peminjaman Bulanan - Bar Chart
    const trenCtx = document.getElementById('trenPeminjamanChart').getContext('2d');
    new Chart(trenCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
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
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 10, font: { size: 10 } },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: {
                        font: function(context) {
                            const index = context.index;
                            const data = context.chart.data.datasets[0].data;
                            const max = Math.max(...data);
                            return { size: 10, weight: data[index] === max ? 'bold' : 'normal' };
                        }
                    },
                    grid: { display: false }
                }
            }
        }
    });

    // Kategori Inventaris - Doughnut Chart
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    const kategoriData = @json($kategoriInventaris);
    const kategoriLabels = Object.keys(kategoriData);
    const kategoriValues = Object.values(kategoriData);
    const kategoriColors = ['#1a3a8a', '#374151', '#9ca3af', '#f59e0b', '#10b981'];

    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: kategoriLabels,
            datasets: [{
                data: kategoriValues,
                backgroundColor: kategoriColors.slice(0, kategoriLabels.length),
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '65%',
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
