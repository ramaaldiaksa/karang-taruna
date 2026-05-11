@extends('layouts.public')

@section('content')
<div class="container py-5 mt-3 mb-5">
    <!-- Header Section -->
    <div class="row align-items-end mb-4 pb-4">
        <div class="col-md-8">
            <h2 class="text-primary fw-semibold mb-2" style="font-size: 1.5rem;">Stok Inventaris</h2>
            <p class="text-muted mb-0" style="font-size: 1rem;">Manajemen ketersediaan sarana dan prasarana Karang Taruna untuk mendukung setiap kegiatan kemasyarakatan.</p>
        </div>
        <div class="col-md-4 text-md-end mt-4 mt-md-0">
            <a href="{{ route('public.peminjaman.create') }}" class="btn btn-primary px-4 py-2 fw-medium shadow-sm" style="border-radius: 6px;">
                <i class="fas fa-plus-circle me-2"></i> Buat Peminjaman
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 6px 0 0 6px;"><i class="fas fa-search"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 py-2" placeholder="Cari nama barang atau kategori..." style="border-radius: 0 6px 6px 0; box-shadow: none;">
            </div>
        </div>
        <div class="col-md-4">
            <select id="filterStatus" class="form-select py-2 shadow-sm" style="border-radius: 6px; border-color: #dee2e6;">
                <option value="semua">Semua Kategori</option>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
            </select>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border shadow-sm mb-4" style="border-radius: 8px; border-color: rgba(0,0,0,0.08) !important;">
        <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0" id="inventarisTable">
                <thead class="bg-light-gray text-muted border-bottom" style="font-size: 0.95rem;">
                    <tr>
                        <th class="ps-4 py-3 fw-semibold" width="8%">No</th>
                        <th class="py-3 fw-semibold">Nama Barang</th>
                        <th class="text-center py-3 fw-semibold" width="20%">Jumlah Total</th>
                        <th class="text-center py-3 fw-semibold" width="20%">Status Ketersediaan</th>
                        <th class="text-center py-3 pe-4 fw-semibold" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventaris as $index => $item)
                    @php
                        $status = $item->jumlah_tersedia > 0 ? 'tersedia' : 'habis';
                    @endphp
                    <tr class="inventaris-row border-bottom" data-name="{{ strtolower($item->nama_barang) }}" data-status="{{ $status }}">
                        <td class="ps-4 py-3 text-muted">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light-gray rounded d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-box text-muted"></i>
                                </div>
                                <span class="text-primary fw-medium">{{ $item->nama_barang }}</span>
                            </div>
                        </td>
                        <td class="text-center py-3 text-dark">{{ $item->jumlah_total }} Unit</td>
                        <td class="text-center py-3">
                            @if($item->jumlah_tersedia > 0)
                                <span class="badge bg-light-blue text-primary px-3 py-2 fw-semibold" style="border-radius: 20px; font-size: 0.8rem; letter-spacing: 0.5px;">TERSEDIA</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 fw-semibold" style="border-radius: 20px; font-size: 0.8rem; letter-spacing: 0.5px;">HABIS</span>
                            @endif
                        </td>
                        <td class="text-center py-3 pe-4">
                            <button class="btn btn-sm text-muted btn-light px-2"><i class="fas fa-ellipsis-v"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-3x mb-3 text-light"></i>
                            <h5 class="fw-medium">Belum ada data inventaris.</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div id="notFoundRow" class="text-center py-5 text-muted" style="display: none;">
                <i class="fas fa-search fa-3x mb-3 text-light"></i>
                <h5 class="fw-medium">Barang tidak ditemukan.</h5>
            </div>
        </div>
        
        @if($inventaris->count() > 0)
        <!-- Pagination Placeholder -->
        <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center">
            <span class="text-muted small">Menampilkan {{ $inventaris->count() }} dari {{ $inventaris instanceof \Illuminate\Pagination\LengthAwarePaginator ? $inventaris->total() : $inventaris->count() }} Inventaris</span>
            <div>
                <!-- Add real pagination if you want, or just placeholder buttons matching design -->
                <button class="btn btn-outline-secondary btn-sm px-3" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline-secondary btn-sm px-3 ms-1" disabled><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
        @endif
    </div>

    <!-- Info Box -->
    <div class="alert bg-light-blue border border-primary border-opacity-25 d-flex align-items-start p-4" style="border-radius: 8px;">
        <i class="fas fa-info-circle text-primary mt-1 me-3 fa-lg"></i>
        <div>
            <h6 class="text-primary fw-semibold mb-1" style="font-size: 0.95rem;">Informasi Peminjaman</h6>
            <p class="text-primary mb-0" style="font-size: 0.9rem;">Pastikan untuk mengajukan permohonan peminjaman maksimal 3 hari sebelum penggunaan barang untuk proses verifikasi administrasi.</p>
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
