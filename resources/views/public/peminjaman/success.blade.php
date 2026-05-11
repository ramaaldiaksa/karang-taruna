@extends('layouts.public')

@section('content')
<div class="container py-5 mt-3 mb-5">
    
    <!-- Stepper -->
    <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center position-relative">
                <!-- Line -->
                <div class="position-absolute" style="top: 15px; left: 10%; right: 10%; height: 2px; background-color: var(--bs-primary); z-index: 1;"></div>
                
                <!-- Step 1 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem;">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="text-primary fw-semibold" style="font-size: 0.85rem;">Data Diri</span>
                </div>

                <!-- Step 2 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem;">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="text-primary fw-semibold" style="font-size: 0.85rem;">Detail Barang</span>
                </div>

                <!-- Step 3 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;">
                    <div class="rounded-circle bg-white text-primary border border-primary border-2 d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem;">
                        3
                    </div>
                    <span class="text-dark fw-semibold" style="font-size: 0.85rem;">Konfirmasi Selesai</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border shadow-sm h-100" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                <div class="card-body p-5 text-center">
                    
                    <div class="d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px; background-color: #e8f5e9; border-radius: 20px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 2.5rem;"></i>
                    </div>
                    
                    <h4 class="text-primary fw-semibold mb-3">Permohonan Peminjaman Berhasil Dikirim</h4>
                    <p class="text-muted mx-auto mb-5" style="max-width: 500px; font-size: 0.95rem; line-height: 1.6;">
                        Permohonan Anda sedang dalam proses verifikasi oleh admin Karang Taruna. Mohon tunggu informasi selanjutnya melalui WhatsApp.
                    </p>

                    <div class="bg-light-gray text-start p-4 mb-5" style="border-radius: 12px;">
                        <h6 class="text-primary fw-semibold border-bottom pb-3 mb-4" style="font-size: 0.95rem;">Ringkasan Peminjaman</h6>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <span class="d-block text-muted small fw-semibold tracking-wider mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">NAMA LENGKAP</span>
                                <span class="text-dark fw-medium">{{ $peminjaman->masyarakat->nama }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-muted small fw-semibold tracking-wider mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">NO. WHATSAPP</span>
                                <span class="text-dark fw-medium">{{ $peminjaman->masyarakat->no_telepon }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-muted small fw-semibold tracking-wider mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">TANGGAL PINJAM</span>
                                <span class="text-dark fw-medium">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="d-block text-muted small fw-semibold tracking-wider mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">TANGGAL KEMBALI</span>
                                <span class="text-dark fw-medium">{{ \Carbon\Carbon::parse($peminjaman->rencana_kembali)->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>

                        <div>
                            <span class="d-block text-muted small fw-semibold tracking-wider mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">BARANG YANG DIPINJAM</span>
                            @foreach($peminjaman->detail as $item)
                            <div class="bg-white p-3 mb-2 d-flex align-items-center border shadow-sm" style="border-radius: 8px; border-color: rgba(0,0,0,0.05) !important;">
                                <i class="fas fa-box text-primary me-3"></i>
                                <span class="text-dark fw-medium" style="font-size: 0.95rem;">{{ $item->inventaris->nama_barang }} ({{ $item->jumlah_pinjam }} Unit)</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 6px; font-weight: 500;">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Card Ketentuan -->
            <div class="card border shadow-sm mb-4" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important; background-color: #fcfcfc;">
                <div class="card-body p-4">
                    <h6 class="text-dark fw-semibold mb-4 d-flex align-items-center">
                        <i class="fas fa-gavel text-primary me-2"></i> Ketentuan Peminjaman
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="far fa-circle text-primary mt-1 me-3" style="font-size: 0.6rem;"></i>
                            <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Barang wajib dikembalikan dalam kondisi bersih dan utuh sesuai jumlah awal.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="far fa-circle text-primary mt-1 me-3" style="font-size: 0.6rem;"></i>
                            <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Keterlambatan pengembalian akan dikenakan sanksi sosial atau denda administratif.</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="far fa-circle text-primary mt-1 me-3" style="font-size: 0.6rem;"></i>
                            <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Kerusakan barang menjadi tanggung jawab penuh peminjam untuk diperbaiki/diganti.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Card Bantuan (Dark) -->
            <div class="card bg-primary text-white border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3 d-flex align-items-center">
                        <i class="far fa-question-circle me-2"></i> Butuh Bantuan?
                    </h6>
                    <p class="text-white-50 mb-4" style="font-size: 0.9rem; line-height: 1.6;">
                        Jika Anda mengalami kendala dalam proses peminjaman, silakan hubungi tim administrasi kami.
                    </p>
                    <a href="#" class="btn btn-light text-primary w-100 fw-medium shadow-sm" style="border-radius: 6px;">
                        <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Card Estimasi -->
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background-color: #f1f3f5;">
                <div class="card-body p-4">
                    <h6 class="text-primary fw-semibold mb-3" style="font-size: 0.95rem;">Estimasi Waktu Verifikasi</h6>
                    <div class="d-flex align-items-start">
                        <i class="far fa-clock text-warning mt-1 me-3 fa-lg"></i>
                        <div>
                            <span class="d-block text-dark fw-bold mb-1">1-3 Jam Kerja</span>
                            <span class="text-muted small">Senin - Sabtu, 08:00 - 16:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
