@extends('layouts.public')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fas fa-wallet text-success me-2"></i>Laporan Keuangan Transparan</h2>

    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white border-0 shadow">
                <div class="card-body p-4 text-center">
                    <h5 class="card-title">Saldo Kas Saat Ini</h5>
                    <h3 class="display-6 fw-bold">Rp {{ number_format($saldo, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white border-0 shadow">
                <div class="card-body p-4 text-center">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <h3 class="display-6 fw-bold">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-danger text-white border-0 shadow">
                <div class="card-body p-4 text-center">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <h3 class="display-6 fw-bold">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title border-bottom pb-3 mb-4">Riwayat Transaksi</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keuangan as $trx)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                            <td>{{ $trx->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                @if($trx->jenis_transaksi == 'pemasukan')
                                    <span class="badge bg-success">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger">Pengeluaran</span>
                                @endif
                            </td>
                            <td class="text-end fw-bold text-{{ $trx->jenis_transaksi == 'pemasukan' ? 'success' : 'danger' }}">
                                Rp {{ number_format($trx->jumlah, 2, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data transaksi keuangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
