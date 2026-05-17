@extends('layouts.admin')
@section('title', 'Kelola Inventaris')

@section('content')
@php
    $kategoriLabel = function ($namaBarang) {
        $nama = strtolower($namaBarang);

        if (str_contains($nama, 'proyektor') || str_contains($nama, 'laptop') || str_contains($nama, 'speaker') || str_contains($nama, 'sound') || str_contains($nama, 'mikrofon') || str_contains($nama, 'kamera') || str_contains($nama, 'kabel')) {
            return 'Elektronik';
        }

        if (str_contains($nama, 'kursi') || str_contains($nama, 'meja') || str_contains($nama, 'lemari') || str_contains($nama, 'rak')) {
            return 'Furnitur';
        }

        return 'Perlengkapan';
    };
@endphp

{{-- Modal Tambah Inventaris --}}
<x-admin.modal id="modalTambahInventaris" title="Tambah Inventaris" icon="fas fa-plus-circle">
    <form action="{{ route('admin.inventaris.store') }}" method="POST">
        @csrf
        <div class="modal-body admin-modal__body">
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary small">ID / Kode Barang</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                    <input type="text" class="form-control bg-light fw-bold text-primary" value="{{ $kodeBaru }}" readonly>
                </div>
                <div class="form-text text-muted">Kode di-generate otomatis oleh sistem.</div>
            </div>

            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Masukkan nama barang..." value="{{ old('nama_barang') }}" required>
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label fw-semibold text-secondary small">Tanggal Masuk <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                    @error('tanggal_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label for="jumlah_total" class="form-label fw-semibold text-secondary small">Jumlah Barang <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-sort-numeric-up text-primary"></i></span>
                    <input type="number" id="jumlah_total" name="jumlah_total" class="form-control @error('jumlah_total') is-invalid @enderror" placeholder="0" min="1" value="{{ old('jumlah_total') }}" required>
                    @error('jumlah_total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-text text-muted">Jumlah tersedia akan diisi otomatis sesuai jumlah total.</div>
            </div>
        </div>
        <x-admin.modal-actions />
    </form>
</x-admin.modal>

{{-- Modal Edit Inventaris --}}
<x-admin.modal id="modalEditInventaris" title="Edit Inventaris" icon="fas fa-pencil-alt">
    <form id="formEditInventaris" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body admin-modal__body">
            <div class="mb-3">
                <label for="edit_nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                    <input type="text" id="edit_nama_barang" name="nama_barang" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="edit_tanggal_masuk" class="form-label fw-semibold text-secondary small">Tanggal Masuk <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                    <input type="date" id="edit_tanggal_masuk" name="tanggal_masuk" class="form-control" required>
                </div>
            </div>

            <div class="mb-2">
                <label for="edit_jumlah_total" class="form-label fw-semibold text-secondary small">Jumlah Barang <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-sort-numeric-up text-primary"></i></span>
                    <input type="number" id="edit_jumlah_total" name="jumlah_total" class="form-control" min="1" required>
                </div>
            </div>
        </div>
        <x-admin.modal-actions submit-label="Simpan Perubahan" />
    </form>
</x-admin.modal>

<x-admin.toolbar :action="route('admin.inventaris.index')">
    <x-admin.search-input placeholder="Cari Kode atau Nama Barang..." />
    <x-admin.filter-select name="kategori" placeholder="Semua Kategori" :options="$kategoriOptions" />
    <x-admin.button data-bs-toggle="modal" data-bs-target="#modalTambahInventaris">Tambah Inventaris</x-admin.button>
</x-admin.toolbar>

<x-admin.table-card :paginator="$inventaris">
    @if($inventaris->count() === 0)
        <div class="admin-table-empty">
            <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Belum ada data inventaris. Klik tombol <strong>Tambah Inventaris</strong> untuk memulai.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>Kode<br>Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th class="text-center">Total<br>Unit</th>
                        <th>Tersedia</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventaris as $item)
                        @php
                            $kategori = $kategoriLabel($item->nama_barang);
                            $tersedia = (int) $item->jumlah_tersedia;
                            $total = max((int) $item->jumlah_total, 1);
                        @endphp
                        <tr>
                            <td><span class="admin-table__code">{{ $item->kode_barang }}</span></td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $kategori }}</td>
                            <td class="text-center text-dark">{{ $item->jumlah_total }}</td>
                            <td>
                                @if($tersedia === 0)
                                    <span class="admin-status-pill admin-status-pill--danger">0 Unit (Habis)</span>
                                @elseif($tersedia <= ($total * 0.2))
                                    <span class="admin-status-pill admin-status-pill--warning">{{ $tersedia }} Unit (Hampir Habis)</span>
                                @elseif($tersedia === $total)
                                    <span class="admin-status-pill admin-status-pill--success">{{ $tersedia }} Unit (Lengkap)</span>
                                @else
                                    <span class="admin-status-pill admin-status-pill--success">{{ $tersedia }} Unit (Tersedia)</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <x-admin.icon-action
                                    title="Edit inventaris"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditInventaris"
                                    data-update-url="{{ route('admin.inventaris.update', $item->id_inventaris) }}"
                                    data-nama="{{ $item->nama_barang }}"
                                    data-tanggal="{{ optional($item->tanggal_masuk)->format('Y-m-d') }}"
                                    data-jumlah="{{ $item->jumlah_total }}"
                                />
                                <form action="{{ route('admin.inventaris.destroy', $item->id_inventaris) }}" method="POST" onsubmit="return confirm('Hapus inventaris ini?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-admin.icon-action type="submit" variant="delete" title="Hapus inventaris" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin.table-card>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahInventaris'));
        modal.show();
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('modalEditInventaris');

    if (!editModal) {
        return;
    }

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const form = document.getElementById('formEditInventaris');

        form.action = button.dataset.updateUrl;
        document.getElementById('edit_nama_barang').value = button.dataset.nama || '';
        document.getElementById('edit_tanggal_masuk').value = button.dataset.tanggal || '';
        document.getElementById('edit_jumlah_total').value = button.dataset.jumlah || '';
    });
});
</script>
@endsection
