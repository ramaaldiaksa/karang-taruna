@extends('layouts.admin')
@section('title', 'Kelola Inventaris')

@section('content')
    <style>
        .inventory-page {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .inventory-hero-card,
        .inventory-filter-card,
        .inventory-table-shell,
        .inventory-summary-card,
        .inventory-activity-card {
            background: #ffffff;
            border: 1px solid #dfe7f3;
            border-radius: 12px;
            box-shadow: 0 10px 28px rgba(24, 39, 75, 0.06);
        }

        .inventory-hero-card {
            align-items: center;
            display: flex;
            justify-content: space-between;
            min-height: 68px;
            padding: 18px 22px 18px 20px;
        }

        .inventory-hero-title {
            color: #0f2f6b;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin: 0;
        }

        .inventory-hero-card .admin-primary-button {
            height: 42px;
            min-width: 188px;
            padding: 0 18px;
            border-radius: 4px;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: none;
        }

        .inventory-filter-card {
            align-items: center;
            display: flex;
            gap: 18px;
            padding: 20px 24px;
        }

        .inventory-filter-form {
            display: grid;
            flex: 1;
            gap: 18px;
            grid-template-columns: minmax(0, 1.35fr) minmax(240px, 0.95fr);
        }

        .inventory-filter-card .admin-primary-button {
            align-items: center;
            display: inline-flex;
            height: 58px;
            justify-content: center;
            min-width: 330px;
            padding: 0 22px;
            border-radius: 4px;
            font-size: 0.93rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            box-shadow: none;
        }

        .inventory-filter-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: minmax(0, 1fr) 210px;
        }

        .inventory-filter-grid .admin-control {
            background: #eef4fb;
            border-color: #e0e8f3;
            border-radius: 4px;
            height: 58px;
            font-size: 0.96rem;
            font-weight: 500;
        }

        .inventory-filter-grid .admin-search i {
            left: 18px;
            font-size: 1.1rem;
        }

        .inventory-filter-grid .admin-search .admin-control {
            padding-left: 56px;
        }

        .inventory-filter-grid .form-select.admin-control {
            padding-left: 18px;
            padding-right: 48px;
        }

        .inventory-filter-card .admin-primary-button i {
            font-size: 0.95rem;
        }

        .inventory-table-shell.admin-table-card {
            background: #ffffff;
            border: 1px solid #e2e9f4;
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(24, 39, 75, 0.05);
            overflow: hidden;
        }

        .inventory-table-shell .table-responsive {
            overflow: hidden;
        }

        .inventory-table-shell .admin-table {
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
            width: 100%;
        }

        .inventory-table-shell .admin-table thead th {
            background: #edf3fb !important;
            border-bottom: 2px solid #d0d9e8 !important;
            color: #2f466b !important;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            padding: 24px 32px !important;
            text-transform: uppercase;
            vertical-align: middle;
        }

        .inventory-table-shell .admin-table tbody tr {
            background: #ffffff;
        }

        .inventory-table-shell .admin-table tbody td {
            border-bottom: 1px solid #dde6f1 !important;
            color: #2f3d52;
            font-size: 0.98rem;
            padding: 28px 32px !important;
            vertical-align: middle;
        }

        .inventory-table-shell .admin-table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        .inventory-table-shell .admin-table tbody tr:hover td {
            background: #fbfdff;
        }

        .inventory-table-shell .admin-table__code {
            color: #0b2e72;
            font-size: 0.96rem;
            font-weight: 800;
        }

        .inventory-table-shell .admin-status-pill {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 8px 14px;
        }

        .inventory-table-shell .admin-pagination {
            background: #f2f6fd;
            border-top: 1px solid #dbe4ef;
            padding: 16px 28px;
            min-height: 64px;
        }

        .inventory-table-shell .admin-pagination__info {
            color: #4e6078;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .inventory-table-shell .admin-pagination__link,
        .inventory-table-shell .admin-pagination__dots {
            height: 38px;
            min-width: 38px;
            font-size: 0.9rem;
        }

        @media (max-width: 991.98px) {

            .inventory-filter-grid,
            .inventory-filter-form {
                grid-template-columns: 1fr;
            }

            .inventory-hero-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .inventory-hero-card .admin-primary-button {
                width: 100%;
                min-width: 0;
            }

            .inventory-filter-card {
                align-items: stretch;
                flex-direction: column;
            }

            .inventory-filter-card .admin-primary-button {
                width: 100%;
                min-width: 0;
                height: 52px;
            }
        }
    </style>

    {{-- Modal Tambah Inventaris --}}
    <x-admin.modal id="modalTambahInventaris" title="Tambah Inventaris" icon="fas fa-plus-circle">
        <form action="{{ route('admin.inventaris.store') }}" method="POST">
            @csrf
            <div class="modal-body admin-modal__body">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">ID / Kode Barang</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                        <input type="text" class="form-control bg-light fw-bold text-primary" value="{{ $kodeBaru }}"
                            readonly>
                    </div>
                    <div class="form-text text-muted">Kode di-generate otomatis oleh sistem.</div>
                </div>

                <div class="mb-3">
                    <label for="nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                        <input type="text" id="nama_barang" name="nama_barang"
                            class="form-control @error('nama_barang') is-invalid @enderror"
                            placeholder="Masukkan nama barang..." value="{{ old('nama_barang') }}" required>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label fw-semibold text-secondary small">Tanggal Masuk <span
                            class="text-danger">*</span></label>
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

                <div class="mb-2">
                    <label for="jumlah_total" class="form-label fw-semibold text-secondary small">Jumlah Barang <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-sort-numeric-up text-primary"></i></span>
                        <input type="number" id="jumlah_total" name="jumlah_total"
                            class="form-control @error('jumlah_total') is-invalid @enderror" placeholder="0" min="1"
                            value="{{ old('jumlah_total') }}" required>
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
                    <label for="edit_nama_barang" class="form-label fw-semibold text-secondary small">Nama Barang <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                        <input type="text" id="edit_nama_barang" name="nama_barang" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit_tanggal_masuk" class="form-label fw-semibold text-secondary small">Tanggal Masuk <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                        <input type="date" id="edit_tanggal_masuk" name="tanggal_masuk" class="form-control" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="edit_jumlah_total" class="form-label fw-semibold text-secondary small">Jumlah Barang <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-sort-numeric-up text-primary"></i></span>
                        <input type="number" id="edit_jumlah_total" name="jumlah_total" class="form-control" min="1"
                            required>
                    </div>
                </div>
            </div>
            <x-admin.modal-actions submit-label="Simpan Perubahan" />
        </form>
    </x-admin.modal>

    {{-- Modal Konfirmasi Hapus Inventaris --}}
    <x-admin.modal id="modalHapusInventaris" title="Hapus Inventaris" icon="fas fa-trash-alt">
        <div class="modal-body admin-modal__body">
            <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus barang <strong id="deleteItemName"></strong>?
                Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="formHapusInventaris" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Hapus Barang
                </button>
            </form>
        </div>
    </x-admin.modal>

    <div class="inventory-page">

        <div class="inventory-filter-card">
            <form action="{{ route('admin.inventaris.index') }}" method="GET" class="inventory-filter-form">
                <x-admin.search-input name="q" placeholder="Cari Kode atau Nama Barang..." :value="request('q')" />
                <x-admin.filter-select name="status" placeholder="Semua Status" :options="collect($statusOptions)
                    ->mapWithKeys(function ($opt) {
                        return [$opt => ucfirst($opt)];
                    })
                    ->toArray()" :autosubmit="true" />
            </form>

            <x-admin.button data-bs-toggle="modal" data-bs-target="#modalTambahInventaris">Tambah
                Inventaris</x-admin.button>
        </div>

        <x-admin.table-card class="inventory-table-shell" :paginator="$inventaris">
            @if ($inventaris->count() === 0)
                <div class="admin-table-empty">
                    <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada data inventaris. Klik tombol <strong>Tambah Inventaris</strong>
                        untuk memulai.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Kode<br>Barang</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Masuk</th>
                                <th class="text-center">Total<br>Unit</th>
                                <th>Tersedia</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $item)
                                @php
                                    $tersedia = (int) $item->jumlah_tersedia;
                                    $total = max((int) $item->jumlah_total, 1);
                                @endphp
                                <tr>
                                    <td><span class="admin-table__code">{{ $item->kode_barang }}</span></td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->tanggal_masuk->format('d/m/Y') }}</td>
                                    <td class="text-center text-dark">{{ $item->jumlah_total }}</td>
                                    <td>
                                        @if ($tersedia === 0)
                                            <span class="admin-status-pill admin-status-pill--danger">0 Unit (Habis)</span>
                                        @elseif($tersedia <= $total * 0.2)
                                            <span class="admin-status-pill admin-status-pill--warning">{{ $tersedia }}
                                                Unit (Hampir Habis)</span>
                                        @elseif($tersedia === $total)
                                            <span class="admin-status-pill admin-status-pill--success">{{ $tersedia }}
                                                Unit (Lengkap)</span>
                                        @else
                                            <span class="admin-status-pill admin-status-pill--success">{{ $tersedia }}
                                                Unit (Tersedia)</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-icon btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#modalHapusInventaris"
                                            data-delete-url="{{ route('admin.inventaris.destroy', $item->id_inventaris) }}"
                                            data-item-name="{{ $item->nama_barang }}" title="Hapus inventaris">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-admin.table-card>

    </div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalTambahInventaris'));
                modal.show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('modalEditInventaris');

            if (!editModal) {
                return;
            }

            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const form = document.getElementById('formEditInventaris');

                form.action = button.dataset.updateUrl;
                document.getElementById('edit_nama_barang').value = button.dataset.nama || '';
                document.getElementById('edit_tanggal_masuk').value = button.dataset.tanggal || '';
                document.getElementById('edit_jumlah_total').value = button.dataset.jumlah || '';
            });

            // Handle delete modal
            const deleteModal = document.getElementById('modalHapusInventaris');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const deleteForm = document.getElementById('formHapusInventaris');
                    const itemNameSpan = document.getElementById('deleteItemName');

                    deleteForm.action = button.dataset.deleteUrl;
                    itemNameSpan.textContent = button.dataset.itemName || 'barang ini';
                });
            }
        });
    </script>
@endsection
