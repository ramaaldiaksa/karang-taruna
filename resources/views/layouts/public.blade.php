<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Karang Taruna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #1a529e;
            --bs-primary-rgb: 26, 82, 158;
        }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Tema Warna Biru Custom */
        .bg-primary { background-color: var(--bs-primary) !important; }
        .text-primary { color: var(--bs-primary) !important; }
        .btn-primary { background-color: var(--bs-primary) !important; border-color: var(--bs-primary) !important; }
        .btn-primary:hover { background-color: #154382 !important; border-color: #154382 !important; }
        .btn-outline-primary { color: var(--bs-primary); border-color: var(--bs-primary); }
        .btn-outline-primary:hover { background-color: var(--bs-primary); color: white; }

        /* Navbar Styling */
        .navbar { padding: 12px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .navbar .nav-link { color: #6c757d; padding: 8px 4px !important; margin: 0 12px; font-weight: 500; border-bottom: 2px solid transparent; transition: all 0.3s ease; }
        .navbar .nav-link:hover { color: var(--bs-primary); border-bottom-color: var(--bs-primary); }
        .navbar .nav-link.active { color: var(--bs-primary); border-bottom-color: var(--bs-primary); }
        .navbar-brand { letter-spacing: 0.5px; font-size: 1.25rem; }

        /* Custom Utilities */
        .bg-light-blue { background-color: #e8f0fe; }
        .bg-light-gray { background-color: #f4f6f8; }
        .icon-box { display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; border-radius: 16px; }
        .icon-box-primary { background-color: #e6f0ff; color: var(--bs-primary); }

        .hero-section { background: linear-gradient(135deg, #00428c, #1a529e); color: white; padding: 5rem 0; margin-bottom: 2rem; }
        .hero-section-home { background: linear-gradient(rgba(0, 32, 96, 0.7), rgba(0, 32, 96, 0.7)), url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=1920') no-repeat center center; background-size: cover; color: white; padding: 8rem 0; margin-bottom: 0; }
        
        .card { border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); }
        .footer { background-color: #212529; color: white; padding: 2rem 0; margin-top: 3rem; }
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
                        <h4 class="fw-bold mb-0 text-white">KARANG TARUNA</h4>
                    </div>
                    <p class="text-white-50 small mb-0" style="line-height: 1.8;">
                        Sistem Informasi Peminjaman dan Inventori.<br>
                        Platform terpadu untuk mengelola inventaris, peminjaman, dan kegiatan operasional organisasi dengan mudah secara transparan.
                    </p>
                </div>
                
                <!-- Menu Utama -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3 text-white">Menu Utama</h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none custom-footer-link">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none custom-footer-link">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('public.berita') }}" class="text-white-50 text-decoration-none custom-footer-link">Berita</a></li>
                        <li class="mb-2"><a href="{{ route('public.inventaris') }}" class="text-white-50 text-decoration-none custom-footer-link">Inventaris</a></li>
                        <li class="mb-2"><a href="{{ route('public.peminjaman.create') }}" class="text-white-50 text-decoration-none custom-footer-link">Peminjaman</a></li>
                        <li class="mb-0"><a href="{{ route('public.keuangan') }}" class="text-white-50 text-decoration-none custom-footer-link">Keuangan</a></li>
                    </ul>
                </div>
                
                <!-- Informasi Kontak -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3 text-white">Informasi Kontak</h6>
                    <ul class="list-unstyled mb-0 text-white-50 small">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-danger me-3 mt-1 px-1"></i>
                            <span style="line-height: 1.6;">Jl. Desa Harapan No. 123,<br>Kecamatan Maju, Kabupaten Sejahtera</span>
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
                <p class="mb-0 text-white-50" style="font-size: 0.85rem;">&copy; {{ date('Y') }} Sistem Informasi Karang Taruna. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <style>
        .custom-footer-link:hover { color: #fff !important; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
