<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Karang Taruna</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Logo no BG.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #1a529e;
            --bs-primary-rgb: 26, 82, 158;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Tema Warna Biru Custom */
        .bg-primary {
            background-color: var(--bs-primary) !important;
        }

        .text-primary {
            color: var(--bs-primary) !important;
        }

        .btn-primary {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }

        .btn-primary:hover {
            background-color: #154382 !important;
            border-color: #154382 !important;
        }

        .btn-outline-primary {
            color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--bs-primary);
            color: white;
        }

        /* Navbar Styling */
        .navbar {
            padding: 12px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar .nav-link {
            color: #6c757d;
            padding: 8px 4px !important;
            margin: 0 12px;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: var(--bs-primary);
            background-color: rgba(26, 82, 158, 0.06);
            border-bottom-color: var(--bs-primary);
            border-radius: 6px;
            transform: translateY(-1px);
        }

        .navbar .nav-link:focus-visible {
            color: var(--bs-primary);
            background-color: rgba(26, 82, 158, 0.08);
            border-bottom-color: var(--bs-primary);
            border-radius: 6px;
            outline: none;
        }

        .navbar .nav-link.active {
            color: var(--bs-primary);
            border-bottom-color: var(--bs-primary);
        }

        .navbar .nav-link.active:hover {
            color: #154382;
            background-color: rgba(26, 82, 158, 0.08);
            border-bottom-color: #154382;
        }

        .navbar-brand {
            letter-spacing: 0.5px;
            font-size: 1.25rem;
        }

        /* Custom Utilities */
        .bg-light-blue {
            background-color: #e8f0fe;
        }

        .bg-light-gray {
            background-color: #f4f6f8;
        }

        .icon-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 16px;
        }

        .icon-box-primary {
            background-color: #e6f0ff;
            color: var(--bs-primary);
        }

        .hero-section {
            background: linear-gradient(135deg, #00428c, #1a529e);
            color: white;
            padding: 5rem 0;
            margin-bottom: 2rem;
        }

        .hero-section-home {
            background: linear-gradient(rgba(0, 32, 96, 0.7), rgba(0, 32, 96, 0.7)), url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1920') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 8rem 0;
            margin-bottom: 0;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .footer {
            background-color: #212529;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
    <style>
        /* Shared styles for About/Home sections (moved from about.blade.php)
           Provides hero shapes, section headings, stats tiles, vision/mission cards */
        .about-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #21458f 0%, #17387a 100%);
            color: #fff;
            padding: 4.5rem 0 6.2rem;
            margin-bottom: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .about-hero::before,
        .about-hero::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.08);
        }

        .about-hero::before {
            width: 38rem;
            height: 38rem;
            left: -10rem;
            bottom: -22rem;
        }

        .about-hero::after {
            width: 60rem;
            height: 60rem;
            right: -20rem;
            bottom: -34rem;
            background: rgba(255, 255, 255, 0.06);
        }

        .about-hero .container,
        .about-page .container {
            position: relative;
            z-index: 1;
        }

        .about-breadcrumb {
            font-size: 0.86rem;
            color: rgba(255, 255, 255, 0.72);
        }

        .about-title {
            font-size: clamp(2.2rem, 4vw, 3.45rem);
            line-height: 1.05;
            letter-spacing: -0.03em;
            max-width: 760px;
        }

        .about-lead {
            max-width: 680px;
            font-size: 1.05rem;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.82);
        }

        .about-page {
            background: #f5f7fb;
        }

        .section-heading-kicker {
            font-size: 0.78rem;
            letter-spacing: 2.4px;
            font-weight: 800;
            color: #24408f;
        }

        .section-heading-title {
            font-size: clamp(1.6rem, 2.6vw, 2.2rem);
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #1d2433;
        }

        .section-copy {
            color: #5d687c;
            line-height: 1.8;
            font-size: 0.98rem;
        }

        .stats-tile {
            border: 0;
            border-radius: 0.85rem;
            background: #ffffff;
            box-shadow: 0 14px 28px rgba(25, 43, 79, 0.06);
            min-height: 150px;
        }

        .stats-tile-icon {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 999px;
            margin: 0 auto 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eef3ff;
            color: #27408f;
            font-size: 1rem;
        }

        .stats-tile-number {
            font-size: 1.9rem;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #233b86;
        }

        .stats-tile-label {
            font-size: 0.85rem;
            color: #6f7b8f;
            margin-bottom: 0;
        }

        .vision-card {
            background: #204086;
            color: #fff;
            border: 0;
            border-radius: 0.85rem;
            box-shadow: 0 16px 32px rgba(26, 58, 138, 0.18);
            min-height: 100%;
            overflow: hidden;
        }

        .vision-card::after {
            content: '';
            position: absolute;
            right: -2rem;
            top: -1rem;
            width: 10rem;
            height: 10rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.07);
        }

        .mission-card {
            background: #ecf2ff;
            border: 0;
            border-radius: 0.85rem;
            box-shadow: 0 16px 32px rgba(26, 58, 138, 0.08);
            min-height: 100%;
        }

        .section-icon-pill {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 0.55rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.12);
            color: currentColor;
        }

        .mission-item {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
        }

        .mission-item i {
            margin-top: 0.2rem;
            color: #294492;
            font-size: 0.95rem;
            flex: 0 0 auto;
        }

        .mission-item p {
            color: #4f5b70;
            line-height: 1.7;
            margin-bottom: 0;
            font-size: 0.92rem;
        }

        /* Image carousel styles */
        .image-carousel {
            position: relative;
        }

        .image-carousel .carousel-inner {
            border-radius: 14px;
            overflow: hidden;
        }

        .image-carousel .carousel-inner img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block;
        }

        .custom-carousel-control {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(8, 32, 71, 0.12);
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }

        .custom-carousel-control.carousel-control-prev {
            left: 18px;
        }

        .custom-carousel-control.carousel-control-next {
            right: 18px;
        }

        .custom-carousel-control .carousel-control-prev-icon,
        .custom-carousel-control .carousel-control-next-icon {
            filter: invert(22%) sepia(100%) saturate(0%) hue-rotate(185deg) brightness(0) contrast(0);
            background-size: 20px 20px;
        }

        .carousel-indicators {
            bottom: 12px;
        }

        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .carousel-indicators .active {
            background-color: #ffffff;
        }
    </style>
</head>

<body>

    @include('components.navbar-public')


    <main class="min-vh-100">
        @yield('content')
    </main>

    <footer class="footer pt-5 pb-3">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Branding -->
                <div class="col-lg-4 col-md-6 pe-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <h4 class="fw-bold mb-0 text-white">SISTEM INFORMASI KARANG TARUNA</h4>
                    </div>
                    <p class="text-white-50 small mb-0" style="line-height: 1.8;">
                        Sistem Informasi Peminjaman dan Inventori.<br>
                        Platform terpadu untuk mengelola inventaris, peminjaman, dan kegiatan operasional organisasi
                        dengan mudah secara transparan.
                    </p>
                </div>

                <!-- Menu Utama -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3 text-white">Menu Utama</h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2"><a href="{{ route('home') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('public.berita') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Berita</a></li>
                        <li class="mb-2"><a href="{{ route('public.inventaris') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Inventaris</a></li>
                        <li class="mb-2"><a href="{{ route('public.peminjaman.create') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Peminjaman</a></li>
                        <li class="mb-0"><a href="{{ route('public.keuangan') }}"
                                class="text-white-50 text-decoration-none custom-footer-link">Keuangan</a></li>
                    </ul>
                </div>

                <!-- Informasi Kontak -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3 text-white">Informasi Kontak</h6>
                    <ul class="list-unstyled mb-0 text-white-50 small">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-danger me-3 mt-1 px-1"></i>
                            <span style="line-height: 1.6;">Jl. Desa Harapan No. 123,<br>Kecamatan Maju, Kabupaten
                                Sejahtera</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-phone-alt text-danger me-3"></i>
                            <span>Emergency: 0812-3456-7890</span>
                        </li>
                    </ul>
                </div>

                <!-- Jam Operasional -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3 text-white">Jam Operasional</h6>
                    <ul class="list-unstyled mb-0 text-white-50 small">
                        <li class="mb-2">Senin - Jumat: 08:00 - 17:00</li>
                        <li>Sabtu - Minggu: 08:00 - 15:00</li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-top border-secondary pt-3 text-center opacity-75">
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">&copy; {{ date('Y') }} Sistem Informasi
                    Karang Taruna. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <style>
        .custom-footer-link:hover {
            color: #fff !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
