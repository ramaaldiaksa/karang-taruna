<nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4 p-3">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">{{ $title ?? 'Dashboard' }}</span>
        <div class="d-flex">
            <span class="navbar-text">
                Selamat datang, <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
            </span>
        </div>
    </div>
</nav>
