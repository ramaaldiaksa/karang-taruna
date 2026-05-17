@extends('layouts.admin')
@section('title', 'Riwayat Pengembalian')

@section('content')
<x-admin.modal id="modalTambahPengembalian" title="Proses Pengembalian Barang" icon="fas fa-undo">
    <form action="{{ route('admin.pengembalian.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_peminjaman" id="id_peminjaman">
        <div class="modal-body admin-modal__body">
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label fw-semibold text-secondary small">Tanggal Kembali <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-primary"></i></span>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali', date('Y-m-d')) }}" required>
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label for="keterangan" class="form-label fw-semibold text-secondary small">Keterangan / Kondisi Barang</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-comment-dots text-primary"></i></span>
                    <textarea id="keterangan" name="keterangan" rows="2" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Contoh: Dikembalikan dalam keadaan baik...">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <x-admin.modal-actions submit-label="Catat Pengembalian" />
    </form>
</x-admin.modal>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Pengembalian Selesai</p>
                    <h3 class="fw-bold mb-0">{{ $pengembalians_count }} Transaksi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-warning text-dark">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-dark bg-opacity-10 rounded-circle p-3 me-3">
                    <i class="fas fa-hourglass-half fa-2x text-dark"></i>
                </div>
                <div>
                    <p class="mb-1 text-dark-50 fw-semibold">Menunggu Barang Kembali</p>
                    <h4 class="fw-bold mb-0 text-dark">{{ $peminjamans->total() }} Transaksi Aktif</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin.toolbar :action="route('admin.pengembalian.index')" class="admin-toolbar admin-toolbar--two">
    <x-admin.search-input placeholder="Cari Nama Peminjam..." />
    <div></div>
</x-admin.toolbar>

<x-admin.table-card :paginator="$peminjamans">
    @if($peminjamans->count() === 0)
        <div class="admin-table-empty">
            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
            <p class="text-muted mb-0">Semua barang telah dikembalikan. Tidak ada peminjaman aktif saat ini.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>No. Pinjaman</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $p)
                    <tr>
                        <td><span class="admin-table__code">#{{ $p->id_peminjaman }}</span></td>
                        <td>{{ $p->masyarakat->nama ?? '-' }}</td>
                        <td class="admin-table__muted">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                        <td class="admin-table__muted">{{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d M Y') }}</td>
                        <td><span class="admin-status-pill admin-status-pill--warning">Belum Kembali</span></td>
                        <td class="text-end">
                            <x-admin.icon-action
                                type="button"
                                variant="view"
                                icon="fas fa-undo"
                                title="Catat pengembalian"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTambahPengembalian"
                                data-id="{{ $p->id_peminjaman }}"
                                class="admin-icon-action admin-icon-action--view btn-catat-kembali"
                            />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin.table-card>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->any())
        var modal = new bootstrap.Modal(document.getElementById('modalTambahPengembalian'));
        modal.show();
        @endif

        const btnCatat = document.querySelectorAll('.btn-catat-kembali');
        const selectPeminjaman = document.getElementById('id_peminjaman');

        btnCatat.forEach(btn => {
            btn.addEventListener('click', function () {
                selectPeminjaman.value = this.getAttribute('data-id') || '';
            });
        });
    });
</script>
@endsection
