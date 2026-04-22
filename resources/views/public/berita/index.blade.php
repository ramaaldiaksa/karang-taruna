@extends('layouts.public')

@section('content')
<div class="bg-primary text-white py-5 text-center mb-5" style="border-radius: 0 0 20px 20px;">
    <div class="container">
        <h1 class="display-5 fw-bold">Berita Karang Taruna</h1>
        <p class="lead">Informasi terbaru seputar kegiatan dan pengumuman Karang Taruna</p>
    </div>
</div>

<div class="container mb-5">
    @if($beritas->count() > 0)
        <div class="row g-4">
            @foreach($beritas as $berita)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="text-muted small mb-2">
                            <i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}
                        </div>
                        <h4 class="card-title fw-bold mb-3">{{ $berita->judul }}</h4>
                        <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($berita->isi), 120) }}</p>
                        <a href="{{ route('public.berita.show', $berita->slug) }}" class="btn btn-outline-primary mt-auto rounded-pill py-2">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $beritas->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">Belum ada berita</h3>
            <p>Berita terbaru akan segera hadir di sini.</p>
        </div>
    @endif
</div>
@endsection
