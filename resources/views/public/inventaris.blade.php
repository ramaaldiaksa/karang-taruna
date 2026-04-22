@extends('layouts.public')

@section('content')
<div class="bg-primary text-white py-5 text-center mb-5" style="border-radius: 0 0 20px 20px;">
    <div class="container">
        <h1 class="display-5 fw-bold">Stok Inventaris</h1>
        <p class="lead">Cek ketersediaan barang sebelum melakukan pengajuan peminjaman</p>
    </div>
</div>

<div class="container my-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <h3 class="fw-bold mb-0 text-dark"><i class="fas fa-boxes text-primary me-2"></i>Daftar Barang</h3>
        <a href="{{ route('public.peminjaman.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Buat Peminjaman
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="d-flex flex-grow-1 w-100 me-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control border-start-0 bg-light" placeholder="Cari berdasarkan nama barang...">
                </div>
            </div>
            <div class="w-100" style="max-width: 280px;">
                <select id="filterStatus" class="form-select bg-light text-dark fw-medium">
                    <option value="semua">Semua Status Ketersediaan</option>
                    <option value="tersedia">Hanya Barangnya Tersedia</option>
                    <option value="habis">Stok Habis</option>
                </select>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="inventarisTable">
                    <thead class="bg-light text-muted" style="font-size: 0.95rem;">
                        <tr>
                            <th class="ps-4 py-3 border-0 rounded-start" width="5%">No</th>
                            <th class="py-3 border-0">Nama Barang</th>
                            <th class="text-center py-3 border-0" width="20%">Jumlah Total</th>
                            <th class="text-center py-3 pe-4 border-0 rounded-end" width="25%">Status Ketersediaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventaris as $index => $item)
                        @php
                            $status = $item->jumlah_tersedia > 0 ? 'tersedia' : 'habis';
                        @endphp
                        <tr class="inventaris-row border-bottom border-light" data-name="{{ strtolower($item->nama_barang) }}" data-status="{{ $status }}">
                            <td class="ps-4 fw-medium text-muted py-3">{{ $index + 1 }}</td>
                            <td class="fw-bold py-3 text-dark fs-6">{{ $item->nama_barang }}</td>
                            <td class="text-center py-3 fw-semibold text-secondary">{{ $item->jumlah_total }}</td>
                            <td class="text-center py-3 pe-4">
                                @if($item->jumlah_tersedia > 0)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center" style="min-width: 120px;">
                                        <i class="fas fa-check-circle me-1"></i> Tersedia {{ $item->jumlah_tersedia }} Unit
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center" style="min-width: 120px;">
                                        <i class="fas fa-times-circle me-1"></i> Habis
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-4x mb-3 text-light"></i>
                                <h5 class="fw-bold">Belum ada data inventaris.</h5>
                                <p class="mb-0">Data inventaris barang Karang Taruna masih kosong.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Not Found Row for JS Search -->
                <div id="notFoundRow" class="text-center py-5 text-muted" style="display: none;">
                    <i class="fas fa-search fa-4x mb-3 text-light"></i>
                    <h5 class="fw-bold">Barang tidak ditemukan.</h5>
                    <p class="mb-0">Coba gunakan kata kunci lain atau ubah filter status pencarian.</p>
                </div>
            </div>
        </div>
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
        if(rows.length === 0) return;

        const searchTerm = searchInput.value.toLowerCase().trim();
        const statusValue = filterStatus.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            const status = row.getAttribute('data-status');
            
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
                tableElement.querySelector('thead').style.display = 'none'; // Sembunyikan header jika tidak ada hasil
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

<style>
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
.badge { font-size: 0.85rem; }
.input-group-text, .form-control, .form-select {
    padding: 0.75rem 1rem;
}
.input-group-text {
    border-radius: 8px 0 0 8px;
}
.form-control {
    border-radius: 0 8px 8px 0;
}
.form-select {
    border-radius: 8px;
}
.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.25rem rgba(26, 82, 158, 0.15);
    border-color: var(--bs-primary);
}
</style>
@endsection
