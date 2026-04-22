@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('public.berita') }}" class="text-decoration-none">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 30) }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid w-100" alt="{{ $berita->judul }}" style="max-height: 500px; object-fit: cover;">
                @endif
                
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div class="text-muted">
                            <i class="far fa-calendar-alt me-2"></i>Diterbitkan pada {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}
                        </div>
                        <div class="share-buttons">
                            <span class="text-muted me-2 small">Bagikan:</span>
                            <a href="#" class="btn btn-sm btn-light rounded-circle text-primary"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-sm btn-light rounded-circle text-info"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-sm btn-light rounded-circle text-success"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    
                    <h1 class="fw-bold mb-4">{{ $berita->judul }}</h1>
                    
                    <div class="berita-content" style="line-height: 1.8; font-size: 1.1rem; color: #444;">
                        {{-- Menggunakan nl2br untuk menghormati baris baru jika disimpan tanpa HTML editor --}}
                        {!! nl2br(e($berita->isi)) !!}
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('public.berita') }}" class="btn btn-primary rounded-pill px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Berita
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
