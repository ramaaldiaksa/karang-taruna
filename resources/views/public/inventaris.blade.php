@extends('layouts.public')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-boxes text-primary me-2"></i>Stok Inventaris</h2>
        <a href="{{ route('public.peminjaman.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Buat Peminjaman</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th class="text-center">Jumlah Total</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventaris as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $item->nama_barang }}</td>
                            <td class="text-center">{{ $item->jumlah_total }}</td>
                            <td class="text-center">
                                @if($item->jumlah_tersedia > 0)
                                    <span class="badge bg-success rounded-pill px-3">{{ $item->jumlah_tersedia }} Unit</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3">Habis</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data inventaris.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
