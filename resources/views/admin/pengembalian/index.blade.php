@extends('layouts.admin')
@section('title', 'Riwayat Pengembalian')

@section('content')

{{-- Modal Proses Pengembalian --}}
<div class="modal fade" id="modalTambahPengembalian" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahLabel">
                    <i class="fas fa-undo me-2"></i>Proses Pengembalian Barang
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.pengembalian.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_peminjaman" id="id_peminjaman">
                <div class="modal-body p-4">
                    
                    {{-- Tanggal Kembali --}}
                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label fw-semibold text-secondary small">Tanggal Kembali <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-primary"></i></span>
                            <input type="date" id="tanggal_kembali" name="tanggal_kembali"
                                   class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                   value="{{ old('tanggal_kembali', date('Y-m-d')) }}" required>
                            @error('tanggal_kembali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-2">
                        <label for="keterangan" class="form-label fw-semibold text-secondary small">Keterangan / Kondisi Barang</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-comment-dots text-primary"></i></span>
                            <textarea id="keterangan" name="keterangan" rows="2"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      placeholder="Contoh: Dikembalikan dalam keadaan baik...">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="fas fa-save me-1"></i>Catat Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Top Cards Summary --}}
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
                    <h4 class="fw-bold mb-0 text-dark">{{ $peminjamans->count() }} Transaksi Aktif</h4>
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
                <h5 class="fw-bold mb-0">Daftar Peminjaman Aktif</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $peminjamans->count() }}</strong> peminjaman yang belum dikembalikan</p>
            </div>
        </div>

        {{-- Tabel --}}
        @if($peminjamans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p class="text-muted">Semua barang telah dikembalikan. Tidak ada peminjaman aktif saat ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">No. Pinjaman</th>
                            <th class="text-secondary small fw-semibold">Peminjam</th>
                            <th class="text-secondary small fw-semibold">Tanggal Pinjam</th>
                            <th class="text-secondary small fw-semibold">Rencana Kembali</th>
                            <th class="text-secondary small fw-semibold">Status</th>
                            <th class="text-secondary small fw-semibold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-semibold">#{{ $p->id_peminjaman }}</span></td>
                            <td class="fw-semibold">{{ $p->masyarakat->nama ?? '-' }}</td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1"><i class="fas fa-hourglass-half me-1"></i>Belum Kembali</span>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-primary px-3 shadow-sm btn-catat-kembali"
                                        data-bs-toggle="modal" data-bs-target="#modalTambahPengembalian"
                                        data-id="{{ $p->id_peminjaman }}">
                                    <i class="fas fa-undo me-1"></i>Catat Kembali
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- Auto-buka modal jika ada error validasi --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->any())
        var modal = new bootstrap.Modal(document.getElementById('modalTambahPengembalian'));
        modal.show();
        @endif

        const btnCatat = document.querySelectorAll('.btn-catat-kembali');
        const selectPeminjaman = document.getElementById('id_peminjaman');
        const btnCatatUtama = document.getElementById('btn-catat-utama');

        btnCatat.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                if (id) {
                    selectPeminjaman.value = id;
                }
            });
        });

        if(btnCatatUtama) {
            btnCatatUtama.addEventListener('click', function() {
                selectPeminjaman.value = '';
            });
        }
    });
</script>

@endsection
