@extends('layouts.admin')
@section('title', 'Daftar Surat')

@section('content')

    {{-- Modal Tambah Arsip Surat --}}
    <x-admin.modal id="modalTambahSurat" title="Tambah Arsip Surat" icon="fas fa-plus-circle">
        <form action="{{ route('admin.surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body admin-modal__body">

                {{-- Judul Surat --}}
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold text-secondary small">Judul Surat <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-heading text-primary"></i></span>
                        <input type="text" id="judul" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul surat..."
                            value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Surat --}}
                <div class="mb-3">
                    <label for="jenis_surat" class="form-label fw-semibold text-secondary small">Jenis Surat <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i
                                class="fas fa-envelope-open-text text-primary"></i></span>
                        <select id="jenis_surat" name="jenis_surat"
                            class="form-select @error('jenis_surat') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jenis Surat</option>
                            <option value="surat masuk" {{ old('jenis_surat') == 'surat masuk' ? 'selected' : '' }}>Surat
                                Masuk</option>
                            <option value="surat keluar" {{ old('jenis_surat') == 'surat keluar' ? 'selected' : '' }}>Surat
                                Keluar</option>
                        </select>
                        @error('jenis_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Upload --}}
                <div class="mb-3">
                    <label for="tanggal_upload" class="form-label fw-semibold text-secondary small">Tanggal <span
                            class="text-danger">*</span></label>
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
                    <label for="file_surat" class="form-label fw-semibold text-secondary small">Upload File Surat <span
                            class="text-danger">*</span></label>
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
            <x-admin.modal-actions />
        </form>
    </x-admin.modal>

    {{-- Top Cards Summary --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background-color: #1a3a8a;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-white-50 fw-semibold">Total Arsip</p>
                        <h3 class="fw-bold mb-0">{{ $surats->total() }} Surat</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white " style="background-color: #1a7a3a;">
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
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background-color: #b91c1c;">
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

    <x-admin.toolbar :action="route('admin.surat.index')">
        <x-admin.search-input placeholder="Cari Judul Surat..." />
        <x-admin.filter-select name="jenis_surat" placeholder="Semua Jenis Surat" :options="['surat masuk' => 'Surat Masuk', 'surat keluar' => 'Surat Keluar']" />
        <x-admin.button data-bs-toggle="modal" data-bs-target="#modalTambahSurat">Tambah Arsip</x-admin.button>
    </x-admin.toolbar>

    <x-admin.table-card :paginator="$surats">
        @if ($surats->count() === 0)
            <div class="admin-table-empty">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">Belum ada arsip surat. Klik tombol <strong>Tambah Arsip</strong> untuk memulai.
                </p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul Surat</th>
                            <th>Jenis Surat</th>
                            <th>File</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surats as $s)
                            <tr>
                                <td class="admin-table__muted">
                                    {{ \Carbon\Carbon::parse($s->tanggal_upload)->format('d M Y') }}</td>
                                <td>{{ $s->judul }}</td>
                                <td>
                                    @if ($s->jenis_surat == 'surat masuk')
                                        <span class="admin-status-pill admin-status-pill--success">Masuk</span>
                                    @else
                                        <span class="admin-status-pill admin-status-pill--warning">Keluar</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($s->file_surat)
                                        <a href="{{ Storage::url($s->file_surat) }}" target="_blank"
                                            class="admin-table__code">Lihat File</a>
                                    @else
                                        <span class="admin-table__muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusSurat"
                                        data-delete-url="{{ route('admin.surat.destroy', $s->id_surat) }}"
                                        data-item-title="{{ $s->judul }}" title="Hapus arsip">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-admin.table-card>

    {{-- Modal Konfirmasi Hapus Surat --}}
    <x-admin.modal id="modalHapusSurat" title="Hapus Arsip Surat" icon="fas fa-trash-alt">
        <div class="modal-body admin-modal__body">
            <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus arsip <strong id="deleteSuratTitle"></strong>?
                Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="formHapusSurat" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Hapus Arsip
                </button>
            </form>
        </div>
    </x-admin.modal>

    {{-- Auto-buka modal jika ada error validasi --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalTambahSurat'));
                modal.show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('modalHapusSurat');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var form = document.getElementById('formHapusSurat');
                    var titleEl = document.getElementById('deleteSuratTitle');

                    form.action = button.dataset.deleteUrl;
                    titleEl.textContent = button.dataset.itemTitle || 'arsip ini';
                });
            }
        });
    </script>

@endsection
