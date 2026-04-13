@extends('layouts.admin')
@section('title', 'Kelola Inventaris')

@section('content')

{{-- Modal Tambah Inventaris --}}
<div class="modal fade" id="modalTambahInventaris" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Inventaris
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.inventaris.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">

                    {{-- Kode Barang (readonly, auto-generate) --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small">ID / Kode Barang</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                            <input type="text" class="form-control bg-light fw-bold text-primary"
                                   value="{{ $kodeBaru }}" readonly>
                        </div>
                        <div class="form-text text-muted">Kode di-generate otomatis oleh sistem.</div>
                    </div>

                    {{-- Nama Barang --}}
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                            <input type="text" id="nama_barang" name="nama_barang"
                                   class="form-control @error('nama_barang') is-invalid @enderror"
                                   placeholder="Masukkan nama barang..."
                                   value="{{ old('nama_barang') }}" required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label fw-semibold text-secondary small">Tanggal Masuk <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                                   class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jumlah Barang --}}
                    <div class="mb-2">
                        <label for="jumlah_total" class="form-label fw-semibold text-secondary small">Jumlah Barang <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-sort-numeric-up text-primary"></i></span>
                            <input type="number" id="jumlah_total" name="jumlah_total"
                                   class="form-control @error('jumlah_total') is-invalid @enderror"
                                   placeholder="0" min="1"
                                   value="{{ old('jumlah_total') }}" required>
                            @error('jumlah_total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">Jumlah tersedia akan diisi otomatis sesuai jumlah total.</div>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Daftar Inventaris</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $inventaris->count() }}</strong> jenis barang</p>
            </div>
            <button type="button" class="btn btn-primary px-4 fw-semibold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambahInventaris">
                <i class="fas fa-plus me-2"></i>Tambah Inventaris
            </button>
        </div>

        {{-- Tabel --}}
        @if($inventaris->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data inventaris. Klik tombol <strong>Tambah Inventaris</strong> untuk memulai.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">Kode Barang</th>
                            <th class="text-secondary small fw-semibold">Nama Barang</th>
                            <th class="text-secondary small fw-semibold">Tanggal Masuk</th>
                            <th class="text-secondary small fw-semibold text-center">Jumlah Total</th>
                            <th class="text-secondary small fw-semibold text-center">Tersedia</th>
                            <th class="text-secondary small fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventaris as $item)
                        <tr>
                            <td>
                                <span class="badge bg-primary-subtle text-primary fw-semibold">{{ $item->kode_barang }}</span>
                            </td>
                            <td class="fw-semibold">{{ $item->nama_barang }}</td>
                            <td class="text-muted">{{ $item->tanggal_masuk->format('d M Y') }}</td>
                            <td class="text-center">{{ $item->jumlah_total }}</td>
                            <td class="text-center">
                                @if($item->jumlah_tersedia > 0)
                                    <span class="badge bg-success-subtle text-success">{{ $item->jumlah_tersedia }}</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.inventaris.destroy', $item->id_inventaris) }}" method="POST"
                                      onsubmit="return confirm('Hapus inventaris ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahInventaris'));
        modal.show();
    });
</script>
@endif

@endsection

