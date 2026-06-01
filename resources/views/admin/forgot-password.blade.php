<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password Admin - Karang Taruna</title>
    <link rel="icon" type="image/png" href="{{ asset('image/Logo no BG.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 50% 50%, rgba(7, 18, 78, 0.04) 0%, rgba(4, 16, 51, 0.04) 100%), #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 1.5rem;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(4, 16, 51, 0.08);
            background: #ffffff;
            overflow: hidden;
            transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 22px 45px rgba(4, 16, 51, 0.12);
        }
        .login-header {
            background: linear-gradient(180deg, #07124e 0%, #041033 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            border-bottom: 4px solid #e6a817;
        }
        .login-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: radial-gradient(circle at top right, rgba(230, 168, 23, 0.15), transparent 70%);
            pointer-events: none;
        }
        .brand-subtitle {
            font-size: 11px;
            color: rgba(219, 234, 254, 0.6);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-top: 6px;
            font-weight: 600;
        }
        .icon-wrapper {
            background: rgba(230, 168, 23, 0.12);
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            border: 2px solid rgba(230, 168, 23, 0.25);
            transition: transform 0.3s ease;
        }
        .login-card:hover .icon-wrapper {
            transform: scale(1.05) rotate(5deg);
        }
        .icon-wrapper i {
            color: #e6a817;
        }
        .form-label-custom {
            font-size: 0.85rem;
            color: #495057;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .input-group-custom {
            border: 1.5px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.2s ease;
            background: #ffffff;
        }
        .input-group-custom:focus-within {
            border-color: #07124e;
            box-shadow: 0 0 0 3.5px rgba(7, 18, 78, 0.085);
        }
        .input-group-custom .input-group-text {
            background: transparent;
            border: none;
            color: #6c757d;
            padding-left: 1rem;
            padding-right: 0.75rem;
        }
        .input-group-custom .form-control {
            border: none;
            padding: 0.75rem 1rem 0.75rem 0;
            font-size: 0.95rem;
            background: transparent;
        }
        .input-group-custom .form-control:focus {
            box-shadow: none;
            outline: none;
            background: transparent;
        }
        .btn-admin {
            background: linear-gradient(135deg, #07124e 0%, #041033 100%);
            border: none;
            color: white;
            padding: 0.8rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(7, 18, 78, 0.15);
        }
        .btn-admin:hover {
            background: linear-gradient(135deg, #050d38 0%, #020921 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(7, 18, 78, 0.25);
            color: #ffffff;
        }
        .btn-admin:active {
            transform: translateY(1px);
        }
        .back-link {
            color: #6c757d;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .back-link:hover {
            color: #07124e;
            transform: translateX(-2px);
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <div class="icon-wrapper">
                <i class="fas fa-key fa-2x"></i>
            </div>
            <h4 class="mb-0 fw-bold">Lupa Password</h4>
            <div class="brand-subtitle">Karang Taruna Rimba Ketapan</div>
        </div>
        <div class="card-body p-4 p-sm-5">
            <p class="text-muted text-center small mb-4">
                Masukkan alamat email yang terdaftar pada akun administrator Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
            </p>

            @if(session('status'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 small">
                    <i class="fas fa-check-circle me-1"></i> {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-3">
                    <ul class="mb-0 text-start small ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" id="forgotPasswordForm">
                @csrf
                <div class="mb-4">
                    <label class="form-label-custom">Alamat Email</label>
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="admin@karangtaruna.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-admin" id="btnSubmit">
                        <span id="btnText">Kirim Link Reset</span>
                        <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="text-center">
                    <a href="{{ route('login') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function() {
            var btn = document.getElementById('btnSubmit');
            var text = document.getElementById('btnText');
            var spinner = document.getElementById('btnSpinner');
            
            btn.disabled = true;
            text.textContent = 'Mengirim...';
            spinner.classList.remove('d-none');
        });
    </script>
</body>
</html>
