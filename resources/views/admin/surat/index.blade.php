@extends('layouts.admin')
@section('title', 'Daftar Surat')

@section('content')

{{-- Modal Tambah Arsip Surat --}}
<div class="modal fade" id="modalTambahSurat" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold" id="modalTambahLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Arsip Surat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.surat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">

                    {{-- Judul Surat --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold text-secondary small">Judul Surat <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-heading text-primary"></i></span>
                            <input type="text" id="judul" name="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   placeholder="Masukkan judul surat..."
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jenis Surat --}}
                    <div class="mb-3">
                        <label for="jenis_surat" class="form-label fw-semibold text-secondary small">Jenis Surat <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope-open-text text-primary"></i></span>
                            <select id="jenis_surat" name="jenis_surat" class="form-select @error('jenis_surat') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jenis Surat</option>
                                <option value="surat masuk" {{ old('jenis_surat') == 'surat masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                <option value="surat keluar" {{ old('jenis_surat') == 'surat keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Upload --}}
                    <div class="mb-3">
                        <label for="tanggal_upload" class="form-label fw-semibold text-secondary small">Tanggal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                            <input type="date" id="tanggal_upload" name="tanggal_upload"
                                   class="form-control @error('tanggal_upload') is-invalid @enderror"
                                   value="{{ old('tanggal_upload', date('Y-m-d')) }}" required>
                            @error('tanggal_upload')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- File Surat --}}
                    <div class="mb-2">
                        <label for="file_surat" class="form-label fw-semibold text-secondary small">Upload File Surat <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-file-pdf text-primary"></i></span>
                            <input type="file" id="file_surat" name="file_surat"
                                   class="form-control @error('file_surat') is-invalid @enderror" required>
                            @error('file_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">Format yang didukung: PDF, DOC, DOCX, JPG, PNG. Max 5MB.</div>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Top Cards Summary --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-folder fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Total Arsip</p>
                    <h3 class="fw-bold mb-0">{{ $surats->count() }} Surat</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-success text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-inbox fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-50 fw-semibold">Surat Masuk</p>
                    <h4 class="fw-bold mb-0">{{ $totalSuratMasuk }} Surat</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-warning text-white">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                    <i class="fas fa-paper-plane fa-2x"></i>
                </div>
                <div>
                    <p class="mb-1 text-white-80 fw-semibold">Surat Keluar</p>
                    <h4 class="fw-bold mb-0">{{ $totalSuratKeluar }} Surat</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0">Daftar Arsip Surat</h5>
                <p class="text-muted small mb-0">Total: <strong>{{ $surats->count() }}</strong> dokumen yang telah diarsipkan</p>
            </div>
            <button type="button" class="btn btn-primary px-4 fw-semibold shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                <i class="fas fa-plus me-2"></i>Tambah Arsip
            </button>
        </div>

        {{-- Tabel --}}
        @if($surats->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada arsip surat. Klik tombol <strong>Tambah Arsip</strong> untuk memulai.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary small fw-semibold">Tanggal</th>
                            <th class="text-secondary small fw-semibold">Judul Surat</th>
                            <th class="text-secondary small fw-semibold">Jenis Surat</th>
                            <th class="text-secondary small fw-semibold">File</th>
                            <th class="text-secondary small fw-semibold">Admin</th>
                            <th class="text-secondary small fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $s)
                        <tr>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($s->tanggal_upload)->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $s->judul }}</td>
                            <td>
                                @if($s->jenis_surat == 'surat masuk')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2"><i class="fas fa-inbox me-1"></i>Masuk</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2"><i class="fas fa-paper-plane me-1"></i>Keluar</span>
                                @endif
                            </td>
                            <td>
                                @if($s->file_surat)
                                    <a href="{{ Storage::url($s->file_surat) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download me-1"></i>Lihat File
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $s->admin->name ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.surat.destroy', $s->id_surat) }}" method="POST"
                                      onsubmit="return confirm('Hapus arsip ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- Auto-buka modal jika ada error validasi --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahSurat'));
        modal.show();
    });
</script>
@endif

@endsection
