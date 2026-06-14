@extends('layouts.admin')
@section('title', 'Verifikasi Peminjaman')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background:#1a3a8a;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center me-3"
                    style="width:56px;height:56px;">
                    <i class="fas fa-handshake fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Menunggu Verifikasi</p>
                    <h4 class="fw-bold mb-0">{{ $peminjamans->total() }} Transaksi</h4>
                </div>
            </div>
        </div>
    </div>
</div>

    <x-admin.toolbar :action="route('admin.peminjaman.index')" class="admin-toolbar admin-toolbar--two">
        <x-admin.search-input name="q" placeholder="Cari Nama Peminjam..." :value="request('q')" />
        <div></div>
    </x-admin.toolbar>

    <x-admin.table-card :paginator="$peminjamans">
        @if ($peminjamans->count() === 0)
            <div class="admin-table-empty">
                <i class="fas fa-handshake-slash fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">Belum ada data peminjaman.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th class="text-start">Peminjam</th>
                            <th class="text-start">Kontak</th>
                            <th class="text-center">Jadwal Pinjam</th>
                            <th class="text-center">Jadwal<br>Pengembalian</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $p)
                            <tr>
                                <td class="text-start">
                                    <div>{{ $p->masyarakat->nama ?? '-' }}</div>
                                    <small class="admin-table__muted">Diajukan:
                                        {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}</small>
                                </td>
                                <td class="text-start admin-table__muted">{{ $p->masyarakat->no_telepon ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if ($p->status == 'menunggu')
                                        <span class="admin-status-pill admin-status-pill--warning">Menunggu</span>
                                    @elseif($p->status == 'disetujui')
                                        <span class="admin-status-pill admin-status-pill--success">Disetujui</span>
                                    @elseif($p->status == 'ditolak')
                                        <span class="admin-status-pill admin-status-pill--danger">Ditolak</span>
                                    @else
                                        <span class="admin-status-pill admin-status-pill--success">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#modalVerifikasi{{ $p->id_peminjaman }}"
                                        title="{{ $p->status == 'menunggu' ? 'Verifikasi peminjaman' : 'Detail peminjaman' }}"
                                        style="background: #1a3a8a; border-color: #1a3a8a; color: #fff;">
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

    @foreach ($peminjamans as $p)
        <x-admin.modal id="modalVerifikasi{{ $p->id_peminjaman }}" title="Detail Peminjaman & Verifikasi"
            icon="fas fa-info-circle" size="lg">
            <div class="modal-body admin-modal__body text-start">
                <div class="row mb-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-user me-2 text-primary"></i>Informasi
                            Peminjam</h6>
                        <table class="table table-sm table-borderless small mb-0">
                            <tr>
                                <td width="35%" class="text-muted">Nama</td>
                                <td class="fw-semibold">: {{ $p->masyarakat->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td class="fw-semibold">: {{ $p->masyarakat->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Telepon</td>
                                <td class="fw-semibold">: {{ $p->masyarakat->no_telepon ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td class="fw-semibold">: {{ $p->masyarakat->alamat ?? '-' }}</td>
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
                                    {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Mulai Pinjam</td>
                                <td class="fw-semibold">: {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Rencana Kembali</td>
                                <td class="fw-semibold text-danger">:
                                    {{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d F Y') }}</td>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p->detail as $detail)
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $detail->inventaris->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                                    <td class="text-center fw-bold text-primary">{{ $detail->jumlah_pinjam }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($p->status == 'menunggu')
                    <div class="bg-light p-3 rounded-3 border">
                        <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-gavel me-2 text-primary"></i>Keputusan
                            Verifikasi</h6>
                        <form action="{{ route('admin.peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST">
                            @csrf
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="setuju{{ $p->id_peminjaman }}" value="disetujui" required>
                                    <label class="form-check-label fw-semibold text-success ms-1"
                                        for="setuju{{ $p->id_peminjaman }}">Disetujui</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="tolak{{ $p->id_peminjaman }}" value="ditolak">
                                    <label class="form-check-label fw-semibold text-danger ms-1"
                                        for="tolak{{ $p->id_peminjaman }}">Ditolak</label>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn admin-modal__button admin-modal__button--primary"><i
                                        class="fas fa-save"></i><span>Simpan Keputusan</span></button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </x-admin.modal>
    @endforeach
@endsection
