@extends('layouts.admin')
@section('title', 'Laporan Keuangan')

@section('content')

{{-- Modal Tambah Laporan Keuangan --}}
<x-admin.modal id="modalTambahKeuangan" title="Tambah Data Keuangan" icon="fas fa-plus-circle">
    <form action="{{ route('admin.keuangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body admin-modal__body">

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
        <x-admin.modal-actions />
    </form>
</x-admin.modal>

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

<x-admin.toolbar :action="route('admin.keuangan.index')">
    <x-admin.search-input placeholder="Cari Keterangan Transaksi..." />
    <x-admin.filter-select name="jenis_transaksi" placeholder="Semua Transaksi" :options="['pemasukan' => 'Pemasukan', 'pengeluaran' => 'Pengeluaran']" />
    <x-admin.button data-bs-toggle="modal" data-bs-target="#modalTambahKeuangan">Tambah Data</x-admin.button>
</x-admin.toolbar>

<x-admin.table-card :paginator="$keuangans">
    @if($keuangans->count() === 0)
        <div class="admin-table-empty">
            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Belum ada data laporan keuangan. Klik tombol <strong>Tambah Data</strong> untuk memulai.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Transaksi</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                        <th>Admin</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keuangans as $k)
                    <tr>
                        <td class="admin-table__muted">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($k->jenis_transaksi == 'pemasukan')
                                <span class="admin-status-pill admin-status-pill--success">Pemasukan</span>
                            @else
                                <span class="admin-status-pill admin-status-pill--danger">Pengeluaran</span>
                            @endif
                        </td>
                        <td class="admin-table__muted">{{ $k->keterangan ?: '-' }}</td>
                        <td>
                            @if($k->bukti_transaksi)
                                <a href="{{ Storage::url($k->bukti_transaksi) }}" target="_blank" class="admin-table__code">Lihat</a>
                            @else
                                <span class="admin-table__muted">-</span>
                            @endif
                        </td>
                        <td class="admin-table__muted">{{ $k->admin->name ?? '-' }}</td>
                        <td class="text-end fw-bold {{ $k->jenis_transaksi == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                            {{ $k->jenis_transaksi == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($k->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.keuangan.destroy', $k->id_keuangan) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <x-admin.icon-action type="submit" variant="delete" title="Hapus transaksi" />
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin.table-card>

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
