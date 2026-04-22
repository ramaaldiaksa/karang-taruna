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

<!-- Section Berita Terbaru -->
@if($beritas->count() > 0)
<div class="container my-5 pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Berita Terbaru</h2>
        <a href="{{ route('public.berita') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua Berita</a>
    </div>
    
    <div class="row g-4">
        @foreach($beritas as $berita)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
                <div class="card-body p-4">
                    <div class="text-muted small mb-2">
                        <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}
                    </div>
                    <h5 class="card-title fw-bold mb-3">{{ $berita->judul }}</h5>
                    <p class="card-text text-muted">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                    <a href="{{ route('public.berita.show', $berita->slug) }}" class="btn btn-primary mt-auto rounded-pill px-4">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
