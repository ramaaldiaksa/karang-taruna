@extends('layouts.public')

@section('content')
    <div class="about-page">
        <!-- Hero Section -->
        <div class="about-hero text-start">
            <div class="container">
                <div class="mb-4 about-breadcrumb">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a>
                    <span class="mx-2">/</span>
                    <span class="text-white fw-semibold border-bottom pb-1">Tentang Kami</span>
                </div>
                <h1 class="about-title fw-bold mb-4">Tentang Karang Taruna Rimba Ketapan</h1>
                <p class="about-lead mb-0">
                    Mengenal lebih dekat wadah pengembangan generasi muda yang berdedikasi
                    untuk kemajuan sosial, kemandirian masyarakat, dan transformasi digital
                    pelayanan publik di Desa Palas Aji.
                </p>
            </div>
        </div>

        <!-- Identitas Kami Section -->
        <div class="container py-5 my-4">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5">
                    <div class="pe-lg-4">
                        <div class="section-heading-kicker mb-3">IDENTITAS KAMI</div>
                        <h2 class="section-heading-title fw-bold mb-4">Pemuda Berkarya untuk Kemajuan Desa</h2>
                        <p class="section-copy mb-4">
                            Karang Taruna Rimba Ketapan adalah organisasi kepemudaan di Desa Palas Aji, Kecamatan Palas,
                            Kabupaten Lampung Selatan yang menjadi wadah bagi generasi muda untuk berkontribusi melalui
                            kegiatan sosial, olahraga, budaya, dan pemberdayaan masyarakat.
                        </p>
                        <p class="section-copy mb-0">
                            Sebagai bagian dari masyarakat Desa Palas Aji, Karang Taruna Rimba Ketapan berperan dalam
                            mempererat kebersamaan warga, mengembangkan potensi pemuda, serta mendukung pembangunan desa
                            melalui semangat gotong royong dan kepedulian sosial.
                        </p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card h-100 border-0" style="border-radius:12px; overflow:hidden;">
                        <iframe
                            src="https://www.google.com/maps?q=Balai+Desa+Palas+Aji+Kabupaten+Lampung+Selatan&z=15&output=embed"
                            width="100%" height="420" style="border:0; display:block;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi & Misi Section -->
        <div class="py-5" style="background: #ffffff;">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h3 class="fw-bold mb-3" style="font-size: 1.8rem; color: #1d2433; letter-spacing: -0.03em;">Visi & Misi
                    </h3>
                    <div class="mx-auto" style="width: 56px; height: 4px; border-radius: 999px; background: #24408f;"></div>
                </div>

                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-5">
                        <div class="vision-card position-relative h-100 p-4 p-lg-5">
                            <div class="card-body p-0 position-relative" style="z-index: 1;">
                                <div class="d-inline-flex align-items-center gap-3 mb-4">
                                    <span class="section-icon-pill"><i class="fas fa-eye"></i></span>
                                    <h4 class="fw-bold mb-0" style="font-size: 1.15rem;">Visi Kami</h4>
                                </div>
                                <p class="mb-0"
                                    style="font-size: 1rem; line-height: 1.85; color: rgba(255, 255, 255, 0.9);">
                                    "Menjadi organisasi kepemudaan yang unggul dalam pembinaan generasi muda yang mandiri,
                                    kreatif, dan berwawasan sosial."
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="mission-card h-100 p-4 p-lg-5">
                            <div class="d-flex align-items-center mb-4">
                                <span class="section-icon-pill me-3" style="background: #dbe5ff; color: #24408f;"><i
                                        class="fas fa-flag"></i></span>
                                <h4 class="fw-bold mb-0" style="font-size: 1.15rem; color: #1d2433;">Misi Kami</h4>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mission-item">
                                        <i class="fas fa-chart-line"></i>
                                        <p>Meningkatkan partisipasi aktif pemuda dalam pembangunan desa.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mission-item">
                                        <i class="far fa-lightbulb"></i>
                                        <p>Mengembangkan potensi dan kreativitas generasi muda.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mission-item">
                                        <i class="fas fa-landmark"></i>
                                        <p>Mewujudkan transparansi dan akuntabilitas dalam pengelolaan organisasi.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mission-item">
                                        <i class="fas fa-network-wired"></i>
                                        <p>Membangun jejaring sosial yang kuat antar pemuda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
