@extends('layouts.public')

@section('content')
    <style>
        .inventory-page {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .inventory-table-shell {
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
            margin-bottom: 0;
        }

        .inventory-table-shell .admin-table thead th {
            background: #f4f8fd;
            color: #607089;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            padding-top: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e9f4;
        }

        .inventory-table-shell .admin-table thead th:nth-child(1) {
            width: 16%;
        }

        .inventory-table-shell .admin-table thead th:nth-child(2) {
            width: 32%;
        }

        .inventory-table-shell .admin-table thead th:nth-child(3) {
            width: 18%;
        }

        .inventory-table-shell .admin-table thead th:nth-child(4) {
            width: 16%;
        }

        .inventory-table-shell .admin-table thead th:nth-child(5) {
            width: 18%;
        }

        .inventory-table-shell .admin-table tbody td {
            font-size: 0.95rem;
            padding-top: 18px;
            padding-bottom: 18px;
            border-top: 1px solid #edf2f8;
        }

        .inventory-table-shell .admin-table__code {
            background: #eef4fb;
            border: 1px solid #dce6f3;
            border-radius: 6px;
            color: #1746a2;
            display: inline-flex;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 5px 10px;
        }

        .inventory-table-shell .admin-status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            min-width: 122px;
            padding: 8px 14px;
        }

        .inventory-table-shell .admin-status-pill--danger {
            background: #fde8e8;
            color: #c62828;
        }

        .inventory-table-shell .admin-status-pill--warning {
            background: #fff4db;
            color: #a86a00;
        }

        .inventory-table-shell .admin-status-pill--success {
            background: #e7f7ef;
            color: #157347;
        }

        .inventory-table-shell .admin-table-empty {
            padding: 56px 24px;
            text-align: center;
        }

        .inventory-table-shell .admin-table-empty i {
            color: #c7d3e3;
        }

        .inventory-table-shell .admin-pagination {
            background: #f2f6fd;
            border-top: 1px solid #dbe4ef;
            min-height: 64px;
            padding: 16px 28px;
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

        @media (max-width: 991.98px) {
            .inventory-filter-form {
                grid-template-columns: 1fr;
            }

            .inventory-filter-card {
                align-items: stretch;
                flex-direction: column;
            }
        }
    </style>
    <div class="container py-5 mt-3 mb-5">
        <!-- Header Section -->
        <div class="row align-items-end mb-4 pb-4">
            <div class="col-md-8">
                <h2 class="text-primary fw-semibold mb-2" style="font-size: 1.5rem;">Stok Inventaris</h2>
                <p class="text-muted mb-0" style="font-size: 1rem;">Manajemen ketersediaan sarana dan prasarana Karang Taruna
                    untuk mendukung setiap kegiatan kemasyarakatan.</p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <a href="{{ route('public.peminjaman.create') }}" class="btn btn-primary px-4 py-2 fw-medium shadow-sm"
                    style="border-radius: 6px;">
                    <i class="fas fa-plus-circle me-2"></i> Buat Peminjaman
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 6px 0 0 6px;"><i
                            class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control border-start-0 py-2"
                        placeholder="Cari nama barang atau kategori..."
                        style="border-radius: 0 6px 6px 0; box-shadow: none;">
                </div>
            </div>
            <div class="col-md-4">
                <select id="filterStatus" class="form-select py-2 shadow-sm"
                    style="border-radius: 6px; border-color: #dee2e6;">
                    <option value="semua">Semua Kategori</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
        </div>

        <!-- Table Card -->
        <div class="inventory-table-shell">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0" id="inventarisTable">
                    <thead>
                        <tr>
                            <th class="text-start ps-4">Kode Barang</th>
                            <th class="text-start">Nama Barang</th>
                            <th class="text-start">Tanggal Masuk</th>
                            <th class="text-center">Total Unit</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventaris as $index => $item)
                            @php
                                $tersedia = (int) $item->jumlah_tersedia;
                                $total = max((int) $item->jumlah_total, 1);
                            @endphp
                            <tr class="inventaris-row" data-name="{{ strtolower($item->nama_barang) }}"
                                data-status="{{ $item->status_key }}">
                                <td class="text-start ps-4"><span class="admin-table__code">{{ $item->kode_barang }}</span>
                                </td>
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light-gray rounded d-flex align-items-center justify-content-center me-3"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-box text-muted"></i>
                                        </div>
                                        <span class="text-primary fw-medium">{{ $item->nama_barang }}</span>
                                    </div>
                                </td>
                                <td class="text-start text-dark">{{ $item->tanggal_masuk->format('d/m/Y') }}</td>
                                <td class="text-center text-dark">{{ $item->jumlah_total }}</td>
                                <td class="text-center">
                                    @if ($tersedia === 0)
                                        <span class="admin-status-pill admin-status-pill--danger">0 Unit (Habis)</span>
                                    @elseif ($tersedia <= $total - 1)
                                        <span class="admin-status-pill admin-status-pill--warning">{{ $tersedia }} Unit
                                            (Tersedia)
                                        </span>
                                    @else
                                        <span class="admin-status-pill admin-status-pill--success">{{ $tersedia }} Unit
                                            (Lengkap)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-boxes fa-3x mb-3 text-light"></i>
                                    <h5 class="fw-medium">Belum ada data inventaris.</h5>
                                    <p class="mb-0">Silakan cek kembali nanti ketika data inventaris sudah ditambahkan.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div id="notFoundRow" class="admin-table-empty text-muted" style="display: none;">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h5 class="fw-medium">Barang tidak ditemukan.</h5>
                </div>
            </div>

            @if ($inventaris->count() > 0)
                <div class="admin-pagination d-flex justify-content-between align-items-center">
                    <span class="admin-pagination__info">Menampilkan {{ $inventaris->count() }} dari
                        {{ $inventaris instanceof \Illuminate\Pagination\LengthAwarePaginator ? $inventaris->total() : $inventaris->count() }}
                        Inventaris</span>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm px-3" disabled><i
                                class="fas fa-chevron-left"></i></button>
                        <button class="btn btn-outline-secondary btn-sm px-3 ms-1" disabled><i
                                class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterStatus = document.getElementById('filterStatus');
            const rows = document.querySelectorAll('.inventaris-row');
            const notFoundRow = document.getElementById('notFoundRow');
            const tableElement = document.getElementById('inventarisTable');

            function filterTable() {
                if (rows.length === 0) return;

                const searchTerm = searchInput.value.toLowerCase().trim();
                const statusValue = filterStatus.value;
                let visibleCount = 0;

                rows.forEach(row => {
                    const name = row.getAttribute('data-name') || '';
                    const status = row.getAttribute('data-status') || '';

                    const matchSearch = name.includes(searchTerm);
                    const matchStatus = (statusValue === 'semua') || (status === statusValue);

                    if (matchSearch && matchStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    notFoundRow.style.display = 'block';
                    if (tableElement.querySelector('thead')) {
                        tableElement.querySelector('thead').style.display = 'none';
                    }
                } else {
                    notFoundRow.style.display = 'none';
                    if (tableElement.querySelector('thead')) {
                        tableElement.querySelector('thead').style.display = '';
                    }
                }
            }

            searchInput.addEventListener('input', filterTable);
            filterStatus.addEventListener('change', filterTable);
        });
    </script>
@endsection
