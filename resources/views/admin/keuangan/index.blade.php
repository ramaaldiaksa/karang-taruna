@extends('layouts.admin')
@section('title', 'Laporan Keuangan')

@section('content')

{{-- Modal Tambah Laporan Keuangan --}}
<div class="modal fade" id="modalTambahKeuangan" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Data Keuangan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.keuangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label for="tanggal" class="form-label fw-semibold text-secondary small">Tanggal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                            <input type="date" id="tanggal" name="tanggal"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jenis Transaksi --}}
                    <div class="mb-3">
                        <label for="jenis_transaksi" class="form-label fw-semibold text-secondary small">Jenis Transaksi <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-exchange-alt text-primary"></i></span>
                            <select id="jenis_transaksi" name="jenis_transaksi" class="form-select @error('jenis_transaksi') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jenis Transaksi</option>
                                <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('jenis_transaksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-3">
                        <label for="jumlah" class="form-label fw-semibold text-secondary small">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-primary fw-bold">Rp</span>
                            <input type="number" id="jumlah" name="jumlah"
                                   class="form-control @error('jumlah') is-invalid @enderror"
                                   placeholder="0" min="0"
                                   value="{{ old('jumlah') }}" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-semibold text-secondary small">Keterangan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-align-left text-primary"></i></span>
                            <textarea id="keterangan" name="keterangan" rows="2"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      placeholder="Masukkan keterangan...">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Bukti Transaksi --}}
                    <div class="mb-2">
                        <label for="bukti_transaksi" class="form-label fw-semibold text-secondary small">Bukti Transaksi (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-image text-primary"></i></span>
                            <input type="file" id="bukti_transaksi" name="bukti_transaksi" accept="image/*"
                                   class="form-control @error('bukti_transaksi') is-invalid @enderror">
                            @error('bukti_transaksi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG. Max 2MB.</div>
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

{{-- Top Cards Summary --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-wallet fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Saldo Kas</p>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-success text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-arrow-down fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Pemasukan</p>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-danger text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-arrow-up fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Pengeluaran</p>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
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
                <h5 class="fw-bold mb-0">Riwayat Transaksi</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $keuangans->count() }}</strong> transaksi telah dicatat</p>
            </div>
            <button type="button" class="btn btn-primary px-4 fw-semibold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambahKeuangan">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </button>
        </div>

        {{-- Tabel --}}
        @if($keuangans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data laporan keuangan. Klik tombol <strong>Tambah Data</strong> untuk memulai.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">Tanggal</th>
                            <th class="text-secondary small fw-semibold">Jenis Transaksi</th>
                            <th class="text-secondary small fw-semibold">Keterangan</th>
                            <th class="text-secondary small fw-semibold">Bukti</th>
                            <th class="text-secondary small fw-semibold">Admin</th>
                            <th class="text-secondary small fw-semibold text-end">Jumlah</th>
                            <th class="text-secondary small fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keuangans as $k)
                        <tr>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                            <td>
                                @if($k->jenis_transaksi == 'pemasukan')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2"><i class="fas fa-arrow-down me-1"></i>Pemasukan</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-2"><i class="fas fa-arrow-up me-1"></i>Pengeluaran</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $k->keterangan ?: '-' }}</td>
                            <td>
                                @if($k->bukti_transaksi)
                                    <a href="{{ Storage::url($k->bukti_transaksi) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-image me-1"></i>Lihat
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $k->admin->name ?? '-' }}</td>
                            <td class="text-end fw-bold {{ $k->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                {{ $k->jenis_transaksi == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($k->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.keuangan.destroy', $k->id_keuangan) }}" method="POST"
                                      onsubmit="return confirm('Hapus transaksi ini?')">
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
        var modal = new bootstrap.Modal(document.getElementById('modalTambahKeuangan'));
        modal.show();
    });
</script>
@endif

@endsection
