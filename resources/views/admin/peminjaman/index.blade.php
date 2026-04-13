@extends('layouts.admin')
@section('title', 'Peminjaman Masuk')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Daftar Peminjaman</h5>
                <p class="text-muted small mb-0">Menampilkan semua permohonan peminjaman inventaris</p>
            </div>
        </div>

        @if($peminjamans->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-handshake-slash fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data peminjaman.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">Peminjam</th>
                            <th class="text-secondary small fw-semibold">Kontak</th>
                            <th class="text-secondary small fw-semibold">Jadwal Pinjam</th>
                            <th class="text-secondary small fw-semibold text-center">Status</th>
                            <th class="text-secondary small fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $p)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $p->masyarakat->nama ?? '-' }}</div>
                                <div class="small text-muted">Diajukan: {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}</div>
                            </td>
                            <td>
                                <div class="small"><i class="fas fa-phone-alt text-muted me-1"></i> {{ $p->masyarakat->no_telepon ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="small fw-semibold text-primary">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }} 
                                    <i class="fas fa-arrow-right mx-1 text-muted"></i> 
                                    {{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($p->status == 'menunggu')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Menunggu</span>
                                @elseif($p->status == 'disetujui')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Disetujui</span>
                                @elseif($p->status == 'ditolak')
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Ditolak</span>
                                @else
                                    <span class="badge bg-info"><i class="fas fa-undo me-1"></i>Dikembalikan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary border-0 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalVerifikasi{{ $p->id_peminjaman }}">
                                    @if($p->status == 'menunggu')
                                        <i class="fas fa-clipboard-check me-1"></i> Verifikasi
                                    @else
                                        <i class="fas fa-eye me-1"></i> Detail
                                    @endif
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modals ditempatkan di luar tabel agar tidak merusak struktur HTML -->
            @foreach($peminjamans as $p)
            <div class="modal fade" id="modalVerifikasi{{ $p->id_peminjaman }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h5 class="modal-title fw-bold">
                                <i class="fas fa-info-circle me-2"></i>Detail Peminjaman & Verifikasi
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-start">
                            <div class="row mb-4">
                                <div class="col-md-6 border-end">
                                    <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-user mb-1 me-2 text-primary"></i>Informasi Peminjam</h6>
                                    <table class="table table-sm table-borderless small mb-0">
                                        <tr><td width="35%" class="text-muted">Nama</td><td class="fw-semibold">: {{ $p->masyarakat->nama ?? '-' }}</td></tr>
                                        <tr><td class="text-muted">Email</td><td class="fw-semibold">: {{ $p->masyarakat->email ?? '-' }}</td></tr>
                                        <tr><td class="text-muted">Telepon</td><td class="fw-semibold">: {{ $p->masyarakat->no_telepon ?? '-' }}</td></tr>
                                        <tr><td class="text-muted">Alamat</td><td class="fw-semibold">: {{ $p->masyarakat->alamat ?? '-' }}</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-6 ps-md-4 mt-3 mt-md-0">
                                    <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-calendar-alt mb-1 me-2 text-primary"></i>Jadwal Peminjaman</h6>
                                    <table class="table table-sm table-borderless small mb-0">
                                        <tr><td width="40%" class="text-muted">Tgl Pengajuan</td><td class="fw-semibold">: {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d F Y') }}</td></tr>
                                        <tr><td class="text-muted">Mulai Pinjam</td><td class="fw-semibold">: {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d F Y') }}</td></tr>
                                        <tr><td class="text-muted">Rencana Kembali</td><td class="fw-semibold text-danger">: {{ \Carbon\Carbon::parse($p->rencana_kembali)->format('d F Y') }}</td></tr>
                                    </table>
                                </div>
                            </div>

                            <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-boxes mb-1 me-2 text-primary"></i>Barang yang Dipinjam</h6>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle small">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th class="text-center">Jumlah Pinjam</th>
                                            <th class="text-center">Kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($p->detail as $detail)
                                        <tr>
                                            <td class="fw-semibold">{{ $detail->inventaris->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                                            <td class="text-center fw-bold text-primary">{{ $detail->jumlah_pinjam }}</td>
                                            <td class="text-center">{{ $detail->kondisi_pinjam }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($p->status == 'menunggu')
                            <div class="bg-light p-3 rounded-3 border">
                                <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-gavel mb-1 me-2 text-primary"></i>Keputusan Verifikasi</h6>
                                <form action="{{ route('admin.peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST">
                                    @csrf
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="setuju{{ $p->id_peminjaman }}" value="disetujui" required>
                                            <label class="form-check-label fw-semibold text-success ms-1" for="setuju{{ $p->id_peminjaman }}">
                                                Disetujui
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="tolak{{ $p->id_peminjaman }}" value="ditolak">
                                            <label class="form-check-label fw-semibold text-danger ms-1" for="tolak{{ $p->id_peminjaman }}">
                                                Ditolak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-primary fw-semibold px-4"><i class="fas fa-save me-2"></i>Simpan Keputusan</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
