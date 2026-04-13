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
                <div class="modal-body p-4">

                    {{-- Pilih Peminjaman --}}
                    <div class="mb-3">
                        <label for="id_peminjaman" class="form-label fw-semibold text-secondary small">Pilih Transaksi Peminjaman <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-list text-primary"></i></span>
                            <select id="id_peminjaman" name="id_peminjaman" class="form-select @error('id_peminjaman') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Transaksi --</option>
                                @foreach($peminjamans as $p)
                                    <option value="{{ $p->id_peminjaman }}">
                                        {{ $p->masyarakat->nama ?? '-' }} - #{{ $p->id_peminjaman }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_peminjaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

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
                    <h3 class="fw-bold mb-0">{{ $pengembalians->count() }} Transaksi</h3>
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
                <h5 class="fw-bold mb-0">Riwayat Pengembalian</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $pengembalians->count() }}</strong> proses pengembalian yang tercatat</p>
            </div>
            <button type="button" class="btn btn-primary px-4 fw-semibold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambahPengembalian">
                <i class="fas fa-undo me-2"></i>Catat Pengembalian
            </button>
        </div>

        {{-- Tabel --}}
        @if($pengembalians->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada riwayat pengembalian barang. Klik tombol <strong>Catat Pengembalian</strong> untuk memulai.</p>
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

{{-- Auto-buka modal jika ada error validasi --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahPengembalian'));
        modal.show();
    });
</script>
@endif

@endsection
