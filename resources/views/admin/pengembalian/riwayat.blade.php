@extends('layouts.admin')
@section('title', 'Riwayat Pengembalian')

@section('content')

{{-- Header Card --}}
<div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-history fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Pengembalian Selesai</p>
                    <h3 class="fw-bold mb-0">{{ $pengembalians->count() }} Transaksi</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Riwayat Pengembalian</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $pengembalians->count() }}</strong> proses pengembalian yang tercatat</p>
            </div>
        </div>

        {{-- Tabel --}}
        @if($pengembalians->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada riwayat pengembalian barang.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">No. Pinjaman</th>
                            <th class="text-secondary small fw-semibold">Peminjam</th>
                            <th class="text-secondary small fw-semibold">Tanggal Kembali</th>
                            <th class="text-secondary small fw-semibold">Keterangan / Status</th>
                            <th class="text-secondary small fw-semibold">PIC Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembalians as $p)
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-semibold">#{{ $p->peminjaman->id_peminjaman ?? '-' }}</span></td>
                            <td class="fw-semibold">{{ $p->peminjaman->masyarakat->nama ?? '-' }}</td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                            <td>
                                @if($p->keterangan)
                                    <span class="text-muted">{{ $p->keterangan }}</span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1"><i class="fas fa-check me-1"></i>Selesai</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $p->admin->name ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
