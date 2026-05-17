@extends('layouts.public')

@section('content')
<section style="background-color: #f0f4f8; padding: 3rem 0 4rem;">
    <div class="container">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h6 class="text-primary fw-bold mb-1" style="letter-spacing: 1.5px; font-size: 0.75rem;">UPDATE TERBARU</h6>
                <h2 class="fw-bold mb-0" style="font-size: 1.8rem;">Warta Desa & Kegiatan</h2>
            </div>
            <div class="mt-3 mt-md-0" style="width: 100%; max-width: 280px;">
                <form action="{{ route('public.berita') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" style="border-radius: 8px 0 0 8px;"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" class="form-control border-start-0" placeholder="Cari berita..." value="{{ request('q') }}" style="border-radius: 0 8px 8px 0; box-shadow: none;">
                    </div>
                </form>
            </div>
        </div>

        @if($beritas->count() > 0)
            <!-- Baris Pertama: 2 kolom (featured layout) -->
            <div class="row g-4 mb-4">
                @foreach($beritas as $index => $berita)
                    @if($index == 0)
                    {{-- Card pertama: horizontal (gambar kiri, teks kanan) --}}
                    <div class="col-lg-7">
                        <div class="card h-100 border-0 overflow-hidden" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                            <div class="row g-0 h-100">
                                <div class="col-md-6">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-100 h-100" alt="{{ $berita->judul }}" style="object-fit: cover; min-height: 280px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center w-100 h-100" style="min-height: 280px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                                    <div class="text-primary small fw-medium mb-2 d-flex align-items-center">
                                        <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') }}
                                    </div>
                                    <h4 class="fw-bold mb-2" style="font-size: 1.15rem; line-height: 1.4;">{{ $berita->judul }}</h4>
                                    <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ Str::limit(strip_tags($berita->isi), 120) }}</p>
                                    <div>
                                        <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-primary fw-semibold text-decoration-none" style="font-size: 0.9rem;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($index == 1)
                    {{-- Card kedua: vertikal (gambar atas, teks bawah) --}}
                    <div class="col-lg-5">
                        <div class="card h-100 border-0 overflow-hidden" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="text-primary small fw-medium mb-2 d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') }}
                                </div>
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; line-height: 1.4;">{{ $berita->judul }}</h4>
                                <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-primary fw-semibold text-decoration-none" style="font-size: 0.9rem;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($index >= 2 && $index <= 4)
                        @if($index == 2)
                        {{-- Baris Kedua: 3 kolom --}}
            </div>
            <div class="row g-4 mb-4">
                        @endif
                    <div class="col-md-4">
                        <div class="card h-100 border-0 overflow-hidden" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="text-primary small fw-medium mb-2 d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') }}
                                </div>
                                <h4 class="fw-bold mb-2" style="font-size: 1.05rem; line-height: 1.4;">{{ $berita->judul }}</h4>
                                <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ Str::limit(strip_tags($berita->isi), 90) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-primary fw-semibold text-decoration-none" style="font-size: 0.9rem;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        @if($index == 5)
            </div>
            <div class="row g-4 mb-4">
                        @endif
                    {{-- Baris selanjutnya: 3 kolom --}}
                    <div class="col-md-4">
                        <div class="card h-100 border-0 overflow-hidden" style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="text-primary small fw-medium mb-2 d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d M Y') }}
                                </div>
                                <h4 class="fw-bold mb-2" style="font-size: 1.05rem; line-height: 1.4;">{{ $berita->judul }}</h4>
                                <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">{{ Str::limit(strip_tags($berita->isi), 90) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('public.berita.show', $berita->slug) }}" class="text-primary fw-semibold text-decoration-none" style="font-size: 0.9rem;">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $beritas->links('pagination::bootstrap-5') }}
            </div>
            <style>
                .pagination .page-link {
                    border-radius: 6px;
                    margin: 0 3px;
                    color: #495057;
                    border: 1px solid #dee2e6;
                    padding: 0.4rem 0.75rem;
                }
                .pagination .page-item.active .page-link {
                    background-color: var(--bs-primary);
                    border-color: var(--bs-primary);
                    color: white;
                }
                .pagination .page-link:hover {
                    background-color: #e9ecef;
                }
            </style>
        @else
            <div class="text-center py-5 my-5" style="background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h4 class="text-muted fw-semibold">Belum ada berita</h4>
                <p class="text-muted mb-0">Berita terbaru akan segera hadir di sini.</p>
            </div>
        @endif
    </div>
</section>
@endsection
