<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-4 px-md-5">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Karang Taruna Official Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.berita.*') ? 'active fw-semibold' : '' }}" href="{{ route('public.berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.inventaris') ? 'active fw-semibold' : '' }}" href="{{ route('public.inventaris') }}">Inventaris</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.peminjaman.*') ? 'active fw-semibold' : '' }}" href="{{ route('public.peminjaman.create') }}">Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.keuangan') ? 'active fw-semibold' : '' }}" href="{{ route('public.keuangan') }}">Keuangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-light text-primary ms-2 px-3" href="{{ route('login') }}">Login Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
