<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Karang Taruna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        /* Sidebar: dark navy with highlighted active item */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background: linear-gradient(180deg, #07124e 0%, #041033 100%);
            color: #e6eefc;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 0.5rem;
            margin-bottom: 0.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }

        .sidebar .brand-title {
            font-size: 14px;
            font-weight: 700;
            color: #dbeafe;
            line-height: 1;
        }

        .sidebar .brand-sub {
            font-size: 11px;
            color: rgba(219, 234, 254, 0.6);
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .sidebar-nav {
            flex: 1;
            margin-top: 0.25rem;
        }

        .sidebar .nav-link {
            color: rgba(219, 234, 254, 0.75);
            font-size: 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 8px;
            border-radius: 8px;
            transition: background .15s, color .15s;
            position: relative;
            margin-bottom: 6px;
        }

        .sidebar .nav-link i {
            width: 10px;
            text-align: center;
            color: inherit;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.03);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: rgba(230, 168, 23, 0.10);
            color: #fff;
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            bottom: 6px;
            width: 4px;
            background: #e6a817;
            border-radius: 4px;
        }

        .sidebar-footer {
            padding-top: 0.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.03);
        }

        .sidebar-footer .small-action {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: space-between;
        }

        .content {
            padding: 20px;
            margin-left: 220px;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: none;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <div>
                    <div class="brand-title">ADMIN PANEL</div>
                    <div class="brand-sub">KARANG TARUNA RIMBA KETAPAN</div>
                </div>
            </div>
            <div class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.inventaris.index') }}"
                            class="nav-link {{ request()->routeIs('admin.inventaris.*') ? 'active' : '' }}">
                            <i class="fas fa-box me-2"></i> Kelola Inventaris
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                            <i class="fas fa-handshake me-2"></i> Verifikasi Peminjaman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pengembalian.index') }}"
                            class="nav-link {{ request()->routeIs('admin.pengembalian.index') ? 'active' : '' }}">
                            <i class="fas fa-check-circle me-2"></i> Verifikasi Pengembalian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.riwayat.index') }}"
                            class="nav-link {{ request()->routeIs('admin.riwayat.index') ? 'active' : '' }}">
                            <i class="fas fa-history me-2"></i> Riwayat Peminjaman
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.surat.index') }}"
                            class="nav-link {{ request()->routeIs('admin.surat.*') ? 'active' : '' }}">
                            <i class="fas fa-envelope me-2"></i> Kelola Arsip Surat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.keuangan.index') }}"
                            class="nav-link {{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave me-2"></i> Kelola Laporan Keuangan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.berita.index') }}"
                            class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="fas fa-newspaper me-2"></i> Kelola Berita
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 small"><i
                            class="fas fa-sign-out-alt me-2"></i>
                        Keluar</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content flex-grow-1">
            @include('components.navbar-admin', ['title' => View::yieldContent('title', 'Dashboard')])


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
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
    @stack('scripts')
</body>

</html>
