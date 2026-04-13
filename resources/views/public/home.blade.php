@extends('layouts.public')

@section('content')
<div class="hero-section text-center">
    <div class="container pb-5">
        <h1 class="display-4 fw-bold mb-4">Selamat Datang di Sistem Informasi Karang Taruna</h1>
        <p class="lead mb-4">Membangun generasi muda yang tangguh, produktif, dan bermanfaat bagi masyarakat.</p>
        <a href="{{ route('public.peminjaman.create') }}" class="btn btn-light btn-lg text-primary fw-bold px-5 rounded-pill shadow-sm">Pinjam Inventaris Sekarang</a>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 bg-white">
                <div class="card-body">
                    <i class="fas fa-boxes fa-3x text-primary mb-3"></i>
                    <h3 class="h4 fw-bold">Inventaris Transparan</h3>
                    <p class="text-muted">Lihat stok barang secara real-time sebelum meminjam.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 bg-white">
                <div class="card-body">
                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                    <h3 class="h4 fw-bold">Proses Cepat</h3>
                    <p class="text-muted">Pengajuan peminjaman dilakukan secara online dan diproses dengan cepat.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 p-4 border-0 bg-white">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                    <h3 class="h4 fw-bold">Keuangan Terbuka</h3>
                    <p class="text-muted">Laporan kas dan kegiatan karang taruna bisa dipantau bersama.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
