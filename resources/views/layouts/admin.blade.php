<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Karang Taruna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #343a40; color: white; padding-top: 1rem; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 20px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: white; border-radius: 5px; }
        .content { padding: 20px; }
        .card { box-shadow: 0 0 10px rgba(0,0,0,0.1); border: none; }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0" style="width: 250px;">
            <div class="px-3 mb-4">
                <h4 class="fw-bold">Admin Panel</h4>
            </div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.inventaris.index') }}" class="nav-link {{ request()->routeIs('admin.inventaris.*') ? 'active' : '' }}">
                        <i class="fas fa-box me-2"></i> Kelola Inventaris
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake me-2"></i> Peminjaman Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengembalian.index') }}" class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                        <i class="fas fa-undo me-2"></i> Pengembalian
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.surat.index') }}" class="nav-link {{ request()->routeIs('admin.surat.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope me-2"></i> Arsip Surat
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.keuangan.index') }}" class="nav-link {{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave me-2"></i> Laporan Keuangan
                    </a>
                </li>
            </ul>
            <hr>
            <div class="px-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1">
            @include('components.navbar-admin', ['title' => View::yieldContent('title', 'Dashboard')])


            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
