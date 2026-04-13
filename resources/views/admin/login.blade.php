<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Karang Taruna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { width: 100%; max-width: 400px; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .login-header { background: #343a40; color: white; padding: 2rem; border-radius: 15px 15px 0 0; text-align: center; }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <i class="fas fa-user-shield fa-3x mb-3 text-warning"></i>
            <h4 class="mb-0 fw-bold">Login Admin</h4>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 text-start">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" name="username" class="form-control border-start-0" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" required>
                    </div>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary shadow-sm py-2 fw-bold">Masuk</button>
                </div>
                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted small"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
