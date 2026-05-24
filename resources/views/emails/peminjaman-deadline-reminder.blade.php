<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Batas Waktu Peminjaman - Karang Taruna</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            color: #333333;
        }
        .wrapper {
            width: 100%;
            background-color: #f6f9fc;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background-color: #d97706; /* Amber-orange for alert/reminder */
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #fef3c7;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .intro-text {
            font-size: 15px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 25px;
        }
        .status-box {
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
        }
        .status-title {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .status-desc {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }
        .details-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .details-title {
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .detail-label {
            color: #64748b;
            font-weight: 500;
        }
        .detail-value {
            color: #1e293b;
            font-weight: 700;
        }
        .table-items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table-items th {
            text-align: left;
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            padding-bottom: 8px;
            border-bottom: 1px solid #cbd5e1;
        }
        .table-items td {
            padding: 10px 0;
            font-size: 14px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-card {
            background-color: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 15px;
            border-radius: 4px;
            font-size: 13px;
            color: #166534;
            line-height: 1.5;
            margin-bottom: 25px;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            background-color: #d97706;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(217, 119, 6, 0.15);
        }
        .footer {
            background-color: #f1f5f9;
            padding: 25px 30px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
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
                <h1>PENGINGAT BATAS WAKTU</h1>
                <p>Sistem Informasi Manajemen Inventaris Karang Taruna</p>
            </div>

            <!-- Content -->
            <div class="content">
                <p class="greeting">Halo, {{ $peminjaman->masyarakat->nama }}</p>
                
                <p class="intro-text">
                    Ini adalah email pengingat otomatis bahwa batas waktu peminjaman barang inventaris Anda akan **berakhir esok hari**. Mohon persiapkan barang-barang tersebut untuk dikembalikan tepat waktu.
                </p>

                <!-- Status Box Warning -->
                <div class="status-box">
                    <p class="status-title">🚨 BATAS WAKTU: BESOK</p>
                    <p class="status-desc">Barang harus dikembalikan esok hari sebelum jam kerja sekretariat berakhir.</p>
                </div>

                <!-- Details Card -->
                <div class="details-card">
                    <p class="details-title">Detail Peminjaman & Batas Waktu</p>
                    
                    <div class="detail-row">
                        <span class="detail-label">Kode Peminjaman:</span>
                        <span class="detail-value">#{{ str_pad($peminjaman->id_peminjaman, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Mulai Pinjam:</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Wajib Dikembalikan Pada:</span>
                        <span class="detail-value" style="color: #b45309;">{{ \Carbon\Carbon::parse($peminjaman->rencana_kembali)->translatedFormat('d F Y') }} (Besok)</span>
                    </div>

                    <!-- Items Table -->
                    <table class="table-items">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th style="text-align: right;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman->detail as $dt)
                                <tr>
                                    <td>{{ $dt->inventaris->nama_barang }}</td>
                                    <td style="text-align: right; font-weight: 700;">{{ $dt->jumlah_pinjam }} Unit</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Info Card -->
                <div class="info-card">
                    <strong>Petunjuk Pengembalian:</strong>
                    <ol style="margin: 5px 0 0 0; padding-left: 20px;">
                        <li>Pastikan semua barang dalam kondisi bersih dan lengkap sesuai saat dipinjam.</li>
                        <li>Bawa barang ke sekretariat Karang Taruna dan temui admin yang bertugas.</li>
                        <li>Pastikan admin memverifikasi pengembalian Anda di sistem untuk menyelesaikan status peminjaman Anda.</li>
                    </ol>
                </div>

                <!-- Button -->
                <div class="btn-container">
                    <a href="{{ config('app.url') }}" class="btn">Lihat Detail di Web</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p><strong>Karang Taruna Indonesia</strong></p>
                <p>Email ini dibuat dan dikirimkan secara otomatis oleh sistem penjadwalan harian kami.</p>
                <p>&copy; {{ date('Y') }} Karang Taruna. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
