@extends('layouts.admin')
@section('title', 'Riwayat Pengembalian')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-history fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Pengembalian Selesai</p>
                    <h3 class="fw-bold mb-0">{{ $pengembalians->total() }} Transaksi</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.toolbar :action="route('admin.pengembalian.riwayat')" class="admin-toolbar admin-toolbar--two">
    <x-admin.search-input placeholder="Cari Nama Peminjam..." />
    <div></div>
</x-admin.toolbar>

<x-admin.table-card :paginator="$pengembalians">
    @if($pengembalians->count() === 0)
        <div class="admin-table-empty">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Belum ada riwayat pengembalian barang.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>No. Pinjaman</th>
                        <th>Peminjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Keterangan / Status</th>
                        <th>PIC Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengembalians as $p)
                    <tr>
                        <td><span class="admin-table__code">#{{ $p->peminjaman->id_peminjaman ?? '-' }}</span></td>
                        <td>{{ $p->peminjaman->masyarakat->nama ?? '-' }}</td>
                        <td class="admin-table__muted">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                        <td>
                            @if($p->keterangan)
                                <span class="admin-table__muted">{{ $p->keterangan }}</span>
                            @else
                                <span class="admin-status-pill admin-status-pill--success">Selesai</span>
                            @endif
                        </td>
                        <td class="admin-table__muted">{{ $p->admin->name ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin.table-card>
@endsection
