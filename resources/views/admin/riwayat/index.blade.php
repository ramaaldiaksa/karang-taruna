@extends('layouts.admin')
@section('title', 'Riwayat Peminjaman')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background:#1a3a8a;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="fas fa-history fa-2x"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-white-50 fw-semibold">Total Peminjaman</p>
                        <h3 class="fw-bold mb-0">{{ $pengembalians->total() }} Transaksi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin.toolbar :action="route('admin.riwayat.index')" class="admin-toolbar admin-toolbar--two">
        <x-admin.search-input placeholder="Cari Nama Peminjam..." />
        <div></div>
    </x-admin.toolbar>

    <x-admin.table-card :paginator="$pengembalians">
        @if ($pengembalians->count() === 0)
            <div class="admin-table-empty">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">Belum ada riwayat peminjaman.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>No. Pinjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalians as $p)
                            <tr>
                                <td><span class="admin-table__code">#{{ $p->peminjaman->id_peminjaman ?? '-' }}</span></td>
                                <td>{{ $p->peminjaman->masyarakat->nama ?? '-' }}</td>
                                <td class="admin-table__muted">
                                    {{ \Carbon\Carbon::parse($p->peminjaman->tanggal_pinjam ?? $p->peminjaman->tanggal_pengajuan)->format('d M Y') }}
                                </td>
                                <td class="admin-table__muted">
                                    {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $p->id_pengembalian }}" title="Lihat Detail" style="background: #1a3a8a; border-color: #1a3a8a; color: #fff;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-admin.table-card>

    <!-- Render modals outside of the table for better markup structure -->
    @foreach ($pengembalians as $p)
        <x-admin.modal id="modalDetail{{ $p->id_pengembalian }}" title="Detail Peminjaman"
            icon="fas fa-info-circle" size="lg">
            <div class="modal-body admin-modal__body text-start">
                <div class="row mb-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-user me-2 text-primary"></i>Informasi
                            Peminjam</h6>
                        <table class="table table-sm table-borderless small mb-0">
                            <tr>
                                <td width="35%" class="text-muted">Nama</td>
                                <td class="fw-semibold">: {{ $p->peminjaman->masyarakat->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td class="fw-semibold">: {{ $p->peminjaman->masyarakat->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Telepon</td>
                                <td class="fw-semibold">: {{ $p->peminjaman->masyarakat->no_telepon ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td class="fw-semibold">: {{ $p->peminjaman->masyarakat->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 ps-md-4 mt-3 mt-md-0">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-calendar-alt me-2 text-primary"></i>Jadwal
                            Peminjaman</h6>
                        <table class="table table-sm table-borderless small mb-0">
                            <tr>
                                <td width="40%" class="text-muted">Tgl Pengajuan</td>
                                <td class="fw-semibold">:
                                    {{ \Carbon\Carbon::parse($p->peminjaman->tanggal_pengajuan)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Mulai Pinjam</td>
                                <td class="fw-semibold">:
                                    {{ \Carbon\Carbon::parse($p->peminjaman->tanggal_pinjam ?? $p->peminjaman->tanggal_pengajuan)->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Pengembalian</td>
                                <td class="fw-semibold">:
                                    {{ isset($p->tanggal_kembali) ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d F Y') : '-' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-boxes me-2 text-primary"></i>Barang yang Dipinjam
                </h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle small">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th class="text-center">Jumlah Pinjam</th>
                                <th class="text-center">Kondisi Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p->peminjaman->detail ?? [] as $detail)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $detail->inventaris->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                                    <td class="text-center fw-bold text-primary">{{ $detail->jumlah_pinjam }}</td>
                                    <td class="text-center">{{ $p->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-admin.modal>
    @endforeach
@endsection
