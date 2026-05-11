@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-center d-flex align-items-center" style="padding: 4rem 0; min-height: 250px;">
    <div class="container pb-4">
        <h1 class="display-5 fw-bold mb-3">Berita Karang Taruna</h1>
        <p class="lead mb-0" style="font-size: 1.1rem; color: rgba(255,255,255,0.9);">
            Informasi terkini mengenai kegiatan, pengumuman, dan perkembangan terbaru<br>dari Karang Taruna untuk mewujudkan integritas desa.
        </p>
    </div>
</div>

<div class="container" style="margin-top: 3rem; margin-bottom: 5rem;">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-3 border-bottom">
        <div>
            <h6 class="text-primary fw-semibold tracking-wider mb-2" style="letter-spacing: 1.5px; font-size: 0.8rem;">UPDATE TERBARU</h6>
            <h2 class="fw-bold mb-0" style="font-size: 1.8rem;">Warta Desa & Kegiatan</h2>
        </div>
        <div class="mt-3 mt-md-0" style="width: 100%; max-width: 300px;">
            <form action="{{ route('public.berita') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 6px 0 0 6px;"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control border-start-0" placeholder="Cari berita..." value="{{ request('q') }}" style="border-radius: 0 6px 6px 0; box-shadow: none;">
                </div>
            </form>
        </div>
    </div>

    @if($beritas->count() > 0)
        <!-- Grid -->
        <div class="row g-4 mb-5">
            @foreach($beritas as $berita)
            <div class="col-md-4">
                <div class="card h-100 border text-start bg-white" style="border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border-color: rgba(0,0,0,0.08) !important;">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 220px; object-fit: cover; border-radius: 8px 8px 0 0;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px; border-radius: 8px 8px 0 0;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="text-primary small fw-medium mb-3 d-flex align-items-center">
                            <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') }}
                        </div>
                        <h4 class="card-title fw-bold mb-3" style="font-size: 1.2rem; line-height: 1.4;">{{ $berita->judul }}</h4>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-primary fw-semibold text-decoration-none" style="font-size: 0.95rem;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $beritas->links('pagination::bootstrap-5') }}
        </div>
        <style>
            .pagination .page-link { border-radius: 4px; margin: 0 4px; color: #495057; border: 1px solid #dee2e6; }
            .pagination .page-item.active .page-link { background-color: var(--bs-primary); border-color: var(--bs-primary); color: white; }
        </style>
    @else
        <div class="text-center py-5 my-5 bg-light-gray" style="border-radius: 12px;">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <h4 class="text-muted fw-semibold">Belum ada berita</h4>
            <p class="text-muted mb-0">Berita terbaru akan segera hadir di sini.</p>
        </div>
    @endif
</div>
@endsection
