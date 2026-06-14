@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
        <x-admin.toolbar :action="route('admin.berita.index')" class="admin-toolbar admin-toolbar--two">
            <x-admin.search-input placeholder="Cari Judul atau Penulis..." />
            <x-admin.button data-bs-toggle="modal" data-bs-target="#modalTambahBerita" icon="fas fa-plus-circle">Tambah
                Berita</x-admin.button>
        </x-admin.toolbar>

    <x-admin.modal id="modalTambahBerita" title="Tambah Berita Baru" icon="fas fa-plus-circle" size="lg">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body admin-modal__body">
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold text-secondary small">Judul Berita <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-heading text-primary"></i></span>
                        <input type="text" id="judul" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required
                            placeholder="Masukkan judul berita...">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="gambar" class="form-label fw-semibold text-secondary small">Gambar/Cover <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-image text-primary"></i></span>
                            <input type="file" id="gambar" name="gambar" accept="image/*"
                                class="form-control @error('gambar') is-invalid @enderror" required>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal ukuran: 2MB.</div>
                    </div>

                    <div class="col-md-4">
                        <label for="penulis" class="form-label fw-semibold text-secondary small">Ditulis Oleh <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                            <input type="text" id="penulis" name="penulis"
                                class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis') }}"
                                required placeholder="Nama penulis...">
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="tanggal_terbit" class="form-label fw-semibold text-secondary small">Tanggal Terbit <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                            <input type="date" id="tanggal_terbit" name="tanggal_terbit"
                                class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                value="{{ old('tanggal_terbit', date('Y-m-d')) }}" required>
                            @error('tanggal_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="isi" class="form-label fw-semibold text-secondary small">Isi Berita <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-align-left text-primary"></i></span>
                        <textarea id="isi" name="isi" rows="10" class="form-control @error('isi') is-invalid @enderror" required
                            placeholder="Tuliskan isi berita di sini...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer admin-modal__footer">
                <button type="button" class="btn admin-modal__button admin-modal__button--secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn admin-modal__button admin-modal__button--primary">
                    <i class="fas fa-save"></i>
                    <span>Simpan Berita</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <x-admin.modal id="modalEditBerita" title="Edit Berita" icon="fas fa-edit" size="lg">
        <form id="formEditBerita" action="{{ old('berita_id') ? route('admin.berita.update', old('berita_id')) : '' }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="berita_id" id="editBeritaId" value="{{ old('berita_id') }}">
            <input type="hidden" name="current_gambar" id="editCurrentGambar" value="{{ old('current_gambar') }}">

            <div class="modal-body admin-modal__body">
                <div class="mb-3">
                    <label for="edit_judul" class="form-label fw-semibold text-secondary small">Judul Berita <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-heading text-primary"></i></span>
                        <input type="text" id="edit_judul" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}"
                            required placeholder="Masukkan judul berita...">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="edit_gambar" class="form-label fw-semibold text-secondary small">Gambar/Cover</label>
                        <div id="editGambarPreview" class="mb-2">
                            @if (old('current_gambar'))
                                <img src="{{ asset('storage/' . old('current_gambar')) }}" alt="Preview"
                                    class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-image text-primary"></i></span>
                            <input type="file" id="edit_gambar" name="gambar" accept="image/*"
                                class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG,
                            PNG, GIF. Maksimal 2MB.</div>
                    </div>

                    <div class="col-md-4">
                        <label for="edit_penulis" class="form-label fw-semibold text-secondary small">Ditulis Oleh <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                            <input type="text" id="edit_penulis" name="penulis"
                                class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis') }}"
                                required placeholder="Nama penulis...">
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="edit_tanggal_terbit" class="form-label fw-semibold text-secondary small">Tanggal
                            Terbit <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i
                                    class="fas fa-calendar-alt text-primary"></i></span>
                            <input type="date" id="edit_tanggal_terbit" name="tanggal_terbit"
                                class="form-control @error('tanggal_terbit') is-invalid @enderror"
                                value="{{ old('tanggal_terbit') }}" required>
                            @error('tanggal_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="edit_isi" class="form-label fw-semibold text-secondary small">Isi Berita <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-align-left text-primary"></i></span>
                        <textarea id="edit_isi" name="isi" rows="10" class="form-control @error('isi') is-invalid @enderror"
                            required placeholder="Tuliskan isi berita di sini...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer admin-modal__footer">
                <button type="button" class="btn admin-modal__button admin-modal__button--secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn admin-modal__button admin-modal__button--primary">
                    <i class="fas fa-save"></i>
                    <span>Update Berita</span>
                </button>
            </div>
        </form>
    </x-admin.modal>

    <x-admin.modal id="modalHapusBerita" title="Hapus Berita" icon="fas fa-trash-alt">
        <div class="modal-body admin-modal__body">
            <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus berita <strong id="deleteBeritaTitle"></strong>?
                Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form id="formHapusBerita" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-2"></i>Hapus Berita
                </button>
            </form>
        </div>
    </x-admin.modal>

    <x-admin.table-card :paginator="$beritas">
        @if ($beritas->count() === 0)
            <div class="admin-table-empty">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <p class="mb-0">Belum ada berita. Klik tombol <strong>Tambah Berita</strong> untuk memulai.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center" style="width: 18%;">Tanggal Terbit</th>
                            <th class="text-center" style="width: 12%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td class="text-center">{{ $beritas->firstItem() + $loop->index }}</td>
                                <td class="text-center">
                                    @if ($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                                            class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="admin-table__muted">-</span>
                                    @endif
                                </td>
                                <td class="text-start">
                                    <div>{{ $berita->judul }}</div>
                                    <small
                                        class="admin-table__muted">{{ Str::limit(strip_tags($berita->isi), 50) }}</small>
                                </td>
                                <td class="text-center admin-table__muted">
                                    {{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-icon edit-berita-btn"
                                        style="background:#1a3a8a;border-color:#1a3a8a;color:#fff;" data-bs-toggle="modal"
                                        data-bs-target="#modalEditBerita"
                                        data-update-url="{{ route('admin.berita.update', $berita->id) }}"
                                        data-berita-id="{{ $berita->id }}" data-judul="{{ e($berita->judul) }}"
                                        data-penulis="{{ e($berita->penulis) }}"
                                        data-tanggal-terbit="{{ $berita->tanggal_terbit }}"
                                        data-isi='@json($berita->isi)'
                                        data-gambar-url="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}"
                                        data-gambar-path="{{ $berita->gambar ?? '' }}" title="Edit berita">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger delete-berita-btn"
                                        data-bs-toggle="modal" data-bs-target="#modalHapusBerita"
                                        data-delete-url="{{ route('admin.berita.destroy', $berita->id) }}"
                                        data-item-title="{{ $berita->judul }}" title="Hapus berita">
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editBeritaId = @json(old('berita_id'));
                var modalId = editBeritaId ? 'modalEditBerita' : 'modalTambahBerita';
                var modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-berita-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var form = document.getElementById('formEditBerita');
                    var gambarPreview = document.getElementById('editGambarPreview');

                    form.action = this.dataset.updateUrl;
                    document.getElementById('editBeritaId').value = this.dataset.beritaId;
                    document.getElementById('edit_judul').value = this.dataset.judul || '';
                    document.getElementById('edit_penulis').value = this.dataset.penulis || '';
                    document.getElementById('edit_tanggal_terbit').value = this.dataset
                        .tanggalTerbit || '';
                    document.getElementById('edit_isi').value = this.dataset.isi ? JSON.parse(this
                        .dataset.isi) : '';
                    document.getElementById('editCurrentGambar').value = this.dataset.gambarPath ||
                        '';

                    if (this.dataset.gambarUrl) {
                        gambarPreview.innerHTML = '<img src="' + this.dataset.gambarUrl +
                            '" alt="Preview" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">';
                    } else {
                        gambarPreview.innerHTML = '';
                    }
                });
            });

            var deleteModal = document.getElementById('modalHapusBerita');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var form = document.getElementById('formHapusBerita');
                    var titleEl = document.getElementById('deleteBeritaTitle');

                    form.action = button.dataset.deleteUrl;
                    titleEl.textContent = button.dataset.itemTitle || 'berita ini';
                });
            }
        });
    </script>
@endsection
