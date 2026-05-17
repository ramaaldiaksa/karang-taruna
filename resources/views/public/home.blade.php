@extends('layouts.public')

@section('content')
<div class="hero-section-home text-center d-flex align-items-center">
    <div class="container pb-5">
        <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">Selamat Datang di Sistem<br>Informasi Karang Taruna <br> Rimba Ketapang</h1>
        <p class="lead mb-5" style="font-size: 1.15rem; color: rgba(255,255,255,0.9);">Membangun generasi muda yang tangguh, produktif, dan bermanfaat bagi<br>masyarakat.</p>
        <a href="{{ route('public.peminjaman.create') }}" class="btn btn-light btn-lg text-primary fw-semibold px-4 rounded-3 shadow-sm" style="font-size: 1rem;">Pinjam Inventaris Sekarang</a>
    </div>
</div>

<div class="container bg-light-gray pb-5" style="margin-top: 0; padding-top: 4rem; max-width: 100%;">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="card h-100 p-4 border-0 shadow-sm text-center align-items-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box icon-box-primary mb-4">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Inventaris Transparan</h3>
                        <p class="text-muted small">Cek ketersediaan barang secara real-time untuk memastikan kebutuhan kegiatan selalu terpenuhi.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 border-0 shadow-sm text-center align-items-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box icon-box-primary mb-4">
                            <i class="fas fa-tachometer-alt fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Proses Cepat</h3>
                        <p class="text-muted small">Sistem pengajuan peminjaman online yang efisien, mengurangi birokrasi yang berbelit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 p-4 border-0 shadow-sm text-center align-items-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box icon-box-primary mb-4">
                            <i class="fas fa-wallet fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Keuangan Terbuka</h3>
                        <p class="text-muted small">Laporan kas yang dapat dipantau oleh seluruh anggota untuk menjaga integritas dan kepercayaan.</p>
                    </div>
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
