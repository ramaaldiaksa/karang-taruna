<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Admin - Karang Taruna</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            color: #333333;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f6f9;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(4, 16, 51, 0.06);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(180deg, #07124e 0%, #041033 100%);
            padding: 35px 30px;
            text-align: center;
            color: #ffffff;
            border-bottom: 4px solid #e6a817;
            position: relative;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 11px;
            color: rgba(219, 234, 254, 0.6);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
        }
        .content {
            padding: 40px 35px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #07124e;
            margin-top: 0;
            margin-bottom: 12px;
        }
        .intro-text {
            font-size: 15px;
            color: #495057;
            margin-bottom: 30px;
        }
        .btn-container {
            text-align: center;
            margin: 35px 0;
        }
        .btn {
            background: linear-gradient(135deg, #07124e 0%, #041033 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            display: inline-block;
            box-shadow: 0 6px 20px rgba(7, 18, 78, 0.2);
            border: none;
            transition: all 0.3s ease;
        }
        .warning-box {
            background-color: #fffbeb;
            border-left: 4px solid #e6a817;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 13px;
            color: #854d0e;
            line-height: 1.5;
            margin-bottom: 25px;
        }
        .info-text {
            font-size: 13px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
            margin-top: 30px;
            word-break: break-all;
        }
        .info-text a {
            color: #07124e;
            text-decoration: underline;
        }
        .footer {
            background-color: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <h1>KARANG TARUNA</h1>
                <p>Rimba Ketapan - Panel Admin</p>
            </div>

            <!-- Content -->
            <div class="content">
                <p class="greeting">Halo, {{ $user->name }}</p>
                <p class="intro-text">
                    Anda menerima email ini karena kami menerima permintaan pemulihan kata sandi (reset password) untuk akun administrator Anda. Silakan klik tombol di bawah ini untuk mengatur ulang password Anda:
                </p>

                <!-- Button -->
                <div class="btn-container">
                    <a href="{{ $resetUrl }}" class="btn">Reset Password Anda</a>
                </div>

                <!-- Warning Box -->
                <div class="warning-box">
                    <strong>Penting:</strong> Tautan pemulihan kata sandi ini hanya berlaku selama <strong>60 menit</strong>. Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini dengan aman.
                </div>

                <!-- Link Backup -->
                <div class="info-text">
                    Jika Anda mengalami kendala dengan tombol di atas, salin dan tempel tautan berikut ke browser Anda:<br>
                    <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p><strong>Karang Taruna Rimba Ketapan</strong></p>
                <p>Email ini dikirimkan secara otomatis oleh Sistem Otentikasi Admin.</p>
                <p>&copy; {{ date('Y') }} Karang Taruna. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
