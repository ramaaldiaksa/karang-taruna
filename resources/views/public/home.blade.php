@extends('layouts.public')

@section('content')
    <div class="hero-section-home text-center d-flex align-items-center">
        <div class="container pb-5">
            <h1 class="display-1 fw-bold mb-4" style="line-height: 1.2;">Sistem Informasi<br>Karang Taruna Rimba Ketapan</h1>
            <p class="lead mb-5" style="font-size: 1.15rem; color: rgba(255,255,255,0.9);">Platform digital untuk mengelola
                data inventaris, kegiatan,<br>dan administrasi Karang Taruna secara efektif dan terintegrasi.</p>
            <a href="{{ route('public.peminjaman.create') }}"
                class="btn btn-light btn-lg text-primary fw-semibold px-4 rounded-3 shadow-sm" style="font-size: 1rem;">Ajukan
                Peminjaman</a>
        </div>
    </div>

    <!-- Identitas Kami Section -->
    <div class="container py-5 my-4">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5">
                <div class="pe-lg-4">
                    <h2 class="section-heading-title fw-bold mb-4">Wadah Pembinaan & Tanggung Jawab Sosial</h2>
                    <p class="section-copy mb-4">
                        Karang Taruna merupakan organisasi sosial kemasyarakatan sebagai wadah dan sarana pengembangan
                        setiap anggota masyarakat yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab
                        sosial dari, oleh, dan untuk masyarakat terutama generasi muda.
                    </p>
                    <p class="section-copy mb-0">
                        Sebagai lembaga kepemudaan di tingkat desa, kami berkomitmen untuk menjadi inkubator kreativitas
                        dan kemandirian bagi pemuda, serta menjadi garda terdepan dalam pelayanan kesejahteraan sosial
                        bagi masyarakat luas.
                    </p>
                </div>
            </div>

            <div class="col-lg-7">
                <div id="homeCarousel" class="carousel slide image-carousel rounded-4 overflow-hidden"
                    data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('image/dokumen-2.jpeg') }}"
                                class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('image/dokumentasi-1.jpeg') }}"
                                class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('image/dokumentasi-3.jpeg') }}"
                                class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>

                    <button class="carousel-control-prev custom-carousel-control" type="button"
                        data-bs-target="#homeCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next custom-carousel-control" type="button"
                        data-bs-target="#homeCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Berita Terbaru -->
    @if ($beritas->count() > 0)
        <div class="container my-5 pb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Berita Terbaru</h2>
                <a href="{{ route('public.berita') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua
                    Berita</a>
            </div>

            <div class="row g-4">
                @foreach ($beritas as $berita)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top"
                                    alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <div class="text-muted small mb-2">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}
                                </div>
                                <h5 class="card-title fw-bold mb-3">{{ $berita->judul }}</h5>
                                <p class="card-text text-muted">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                                <a href="{{ route('public.berita.show', $berita->slug) }}"
                                    class="btn btn-primary mt-auto rounded-pill px-4">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
