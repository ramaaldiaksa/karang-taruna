@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Peminjaman</h6>
                        <h2 class="mt-2 mb-0">{{ $totalPeminjaman }}</h2>
                    </div>
                    <i class="fas fa-handshake fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.peminjaman.index') }}" class="text-white text-decoration-none small">Lihat Detail</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Menunggu Verifikasi</h6>
                        <h2 class="mt-2 mb-0">{{ $peminjamanMenunggu }}</h2>
                    </div>
                    <i class="fas fa-clock fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.peminjaman.index') }}" class="text-white text-decoration-none small">Verifikasi Sekarang</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Inventaris</h6>
                        <h2 class="mt-2 mb-0">{{ $totalInventaris }}</h2>
                    </div>
                    <i class="fas fa-boxes fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.inventaris.index') }}" class="text-white text-decoration-none small">Lihat Detail</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-0">Total Transaksi Keuangan</h6>
                        <h2 class="mt-2 mb-0">{{ $totalKeuangan }}</h2>
                    </div>
                    <i class="fas fa-money-bill fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.keuangan.index') }}" class="text-white text-decoration-none small">Lihat Detail</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white fw-bold">
        Peminjaman Terbaru
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamanTerbaru as $p)
                    <tr>
                        <td>{{ $p->masyarakat->nama ?? '-' }}</td>
                        <td>
                            @foreach($p->detail as $d)
                                {{ $d->inventaris->nama_barang ?? '-' }} ({{ $d->jumlah_pinjam }})
                            @endforeach
                        </td>
                        <td>{{ $p->tanggal_pengajuan }}</td>
                        <td>
                            @if($p->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($p->status == 'disetujui')
                                <span class="badge bg-primary">Disetujui</span>
                            @elseif($p->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
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
    </div>
</div>
@endsection
