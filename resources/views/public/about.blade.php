@extends('layouts.public')

@section('content')
<div class="container my-5 py-4">
    <!-- Section: Tentang Karang Taruna -->
    <div class="row align-items-center mb-5 pb-5 border-bottom border-light">
        <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
            <div class="mb-4">
                <h1 class="fw-bold mb-0 text-primary" style="font-size: 2.8rem;">Tentang Karang Taruna</h1>
                <div class="mt-2 mb-4" style="width: 80px; height: 5px; background-color: var(--bs-primary); border-radius: 5px;"></div>
            </div>
            <p class="text-dark fs-5" style="line-height: 1.7;">
                Karang Taruna adalah wadah pembinaan dan pengembangan generasi muda yang tumbuh atas dasar kesadaran dan rasa tanggung jawab sosial dari, oleh, dan untuk masyarakat.
            </p>
            <p class="text-muted fs-6 mt-4" style="line-height: 1.8;">
                Melalui website sistem informasi ini, kami bertujuan untuk memberikan transparansi terkait kegiatan, inventaris, dan keuangan organisasi kepada seluruh lapisan masyarakat.
            </p>
        </div>
        <div class="col-lg-6">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1593113565694-c6a66b9f2eb5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Kegiatan Karang Taruna" 
                     class="img-fluid rounded-4 shadow-lg w-100" 
                     style="object-fit: cover; height: 400px;">
                <div class="position-absolute top-100 start-0 translate-middle ms-5 rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-top: -40px;">
                    <i class="fas fa-users text-primary fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Visi & Misi -->
    <div class="mb-5">
        <h2 class="fw-bold mb-5" style="font-size: 2.5rem;">Visi & Misi</h2>
        <div class="row g-5">
            <!-- Visi -->
            <div class="col-md-5">
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-eye text-primary me-3" style="font-size: 2rem;"></i>
                    <h3 class="fw-bold mb-0">Visi</h3>
                </div>
                <p class="text-dark fs-5" style="line-height: 1.7;">
                    Menjadi organisasi kepemudaan yang unggul dalam pembinaan generasi muda yang mandiri, kreatif, dan berwawasan sosial.
                </p>
            </div>
            
            <!-- Misi -->
            <div class="col-md-7">
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-bullseye text-primary me-3" style="font-size: 2rem;"></i>
                    <h3 class="fw-bold mb-0">Misi</h3>
                </div>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <div class="text-primary mt-1 me-3"><i class="fas fa-check-circle"></i></div>
                        <span class="fs-6" style="line-height: 1.6;">Meningkatkan partisipasi aktif pemuda dalam pembangunan desa.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <div class="text-primary mt-1 me-3"><i class="fas fa-check-circle"></i></div>
                        <span class="fs-6" style="line-height: 1.6;">Mengembangkan potensi dan kreativitas generasi muda.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <div class="text-primary mt-1 me-3"><i class="fas fa-check-circle"></i></div>
                        <span class="fs-6" style="line-height: 1.6;">Mewujudkan transparansi dan akuntabilitas dalam pengelolaan organisasi.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <div class="text-primary mt-1 me-3"><i class="fas fa-check-circle"></i></div>
                        <span class="fs-6" style="line-height: 1.6;">Membangun jejaring sosial yang kuat antar pemuda.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
