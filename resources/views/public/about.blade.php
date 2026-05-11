@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-start" style="padding-bottom: 6rem;">
    <div class="container">
        <div class="mb-4 text-white-50 small">
            <a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a> <span class="mx-2">/</span> <span class="text-white fw-medium border-bottom pb-1">Tentang Kami</span>
        </div>
        <h1 class="fw-semibold mb-4" style="font-size: 1.1rem;">Tentang Karang Taruna</h1>
        <p class="lead mb-0" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6; color: rgba(255,255,255,0.9);">
            Mengenal lebih dekat wadah pengembangan generasi muda yang berdedikasi untuk kemajuan sosial dan kemandirian masyarakat.
        </p>
    </div>
</div>

<!-- Identitas Kami Section -->
<div class="container" style="margin-top: 4rem; margin-bottom: 6rem;">
    <div class="row g-5 align-items-center">
        <!-- Text Content -->
        <div class="col-lg-5 pe-lg-5">
            <h6 class="text-primary fw-semibold tracking-wider mb-4" style="letter-spacing: 2px; font-size: 0.85rem;">IDENTITAS KAMI</h6>
            <h3 class="text-primary fw-semibold mb-4" style="font-size: 1.1rem;">Wadah Pembinaan & Tanggung Jawab Sosial</h3>
            <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.7;">
                Karang Taruna merupakan organisasi sosial kemasyarakatan sebagai wadah dan sarana pengembangan setiap anggota masyarakat yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab sosial dari, oleh, dan untuk masyarakat terutama generasi muda.
            </p>
            <p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.7;">
                Sebagai lembaga kepemudaan di tingkat desa, kami berkomitmen untuk menjadi inkubator kreativitas dan kemandirian bagi pemuda, serta menjadi garda terdepan dalam pelayanan kesejahteraan sosial bagi masyarakat luas.
            </p>
        </div>
        
        <!-- Stats Grid -->
        <div class="col-lg-7">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 p-4 border-0 text-center bg-light-gray" style="border-radius: 8px;">
                        <div class="card-body">
                            <i class="fas fa-users text-primary fa-2x mb-3"></i>
                            <h4 class="text-primary fw-semibold mb-1" style="font-size: 1.1rem;">500+</h4>
                            <p class="text-muted small mb-0">Anggota Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 border-0 text-center bg-light-gray" style="border-radius: 8px;">
                        <div class="card-body">
                            <i class="fas fa-hand-holding-heart text-primary fa-2x mb-3"></i>
                            <h4 class="text-primary fw-semibold mb-1" style="font-size: 1.1rem;">24+</h4>
                            <p class="text-muted small mb-0">Program Sosial</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 border-0 text-center bg-light-gray" style="border-radius: 8px;">
                        <div class="card-body">
                            <i class="fas fa-handshake text-primary fa-2x mb-3"></i>
                            <h4 class="text-primary fw-semibold mb-1" style="font-size: 1.1rem;">15+</h4>
                            <p class="text-muted small mb-0">Mitra Strategis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 border-0 text-center bg-light-gray" style="border-radius: 8px;">
                        <div class="card-body">
                            <i class="fas fa-trophy text-primary fa-2x mb-3"></i>
                            <h4 class="text-primary fw-semibold mb-1" style="font-size: 1.1rem;">10+</h4>
                            <p class="text-muted small mb-0">Penghargaan Desa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visi & Misi Section -->
<div class="bg-light-gray py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h3 class="text-primary fw-semibold d-inline-block pb-2" style="font-size: 1.1rem; border-bottom: 3px solid var(--bs-primary);">Visi & Misi</h3>
        </div>
        
        <div class="row g-4">
            <!-- Visi -->
            <div class="col-md-5">
                <div class="card h-100 border-0 p-4 shadow-sm" style="border-radius: 8px;">
                    <div class="card-body">
                        <div class="icon-box bg-light-blue text-primary mb-4" style="width: 50px; height: 50px; border-radius: 8px;">
                            <i class="fas fa-eye fa-lg"></i>
                        </div>
                        <h5 class="text-primary fw-semibold mb-4" style="font-size: 1rem;">Visi Kami</h5>
                        <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                            "Menjadi organisasi kepemudaan yang unggul dalam pembinaan generasi muda yang mandiri, kreatif, dan berwawasan sosial."
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Misi -->
            <div class="col-md-7">
                <div class="card h-100 border-0 p-4 shadow-sm" style="border-radius: 8px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-light-blue text-primary me-3" style="width: 50px; height: 50px; border-radius: 8px;">
                                <i class="fas fa-flag fa-lg"></i>
                            </div>
                            <h5 class="text-primary fw-semibold mb-0" style="font-size: 1rem;">Misi Kami</h5>
                        </div>
                        
                        <div class="row g-4 mt-1">
                            <div class="col-md-6 d-flex align-items-start">
                                <i class="fas fa-chart-line text-primary mt-1 me-3"></i>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Meningkatkan partisipasi aktif pemuda dalam pembangunan desa.</p>
                            </div>
                            <div class="col-md-6 d-flex align-items-start">
                                <i class="far fa-lightbulb text-primary mt-1 me-3"></i>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Mengembangkan potensi dan kreativitas generasi muda.</p>
                            </div>
                            <div class="col-md-6 d-flex align-items-start">
                                <i class="fas fa-landmark text-primary mt-1 me-3"></i>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Mewujudkan transparansi dan akuntabilitas dalam pengelolaan organisasi.</p>
                            </div>
                            <div class="col-md-6 d-flex align-items-start">
                                <i class="fas fa-network-wired text-primary mt-1 me-3"></i>
                                <p class="text-muted small mb-0" style="line-height: 1.6;">Membangun jejaring sosial yang kuat antar pemuda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
