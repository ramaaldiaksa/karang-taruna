<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid px-4 px-md-5">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('image/Logo_Karang_Taruna_New.jpg') }}" alt="Logo Karang Taruna" height="38"
                class="me-2">
            <span>Karang Taruna Rimba Ketapan</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                        href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}"
                        href="{{ route('about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.berita') || request()->routeIs('public.berita.*') ? 'active fw-semibold' : '' }}"
                        href="{{ route('public.berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.inventaris') ? 'active fw-semibold' : '' }}"
                        href="{{ route('public.inventaris') }}">Inventaris</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.peminjaman.*') ? 'active fw-semibold' : '' }}"
                        href="{{ route('public.peminjaman.create') }}">Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.keuangan') ? 'active fw-semibold' : '' }}"
                        href="{{ route('public.keuangan') }}">Keuangan</a>
                </li>
            </ul>
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <a class="btn btn-primary px-4 py-2 fw-semibold" style="border-radius: 6px;"
                    href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</nav>
