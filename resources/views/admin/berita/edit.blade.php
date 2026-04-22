@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2 text-warning"></i> Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="gambar" class="form-label fw-bold">Gambar/Cover</label>
                    @if($berita->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF. Maks: 2MB.</div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="tanggal_terbit" class="form-label fw-bold">Tanggal Terbit <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror" id="tanggal_terbit" name="tanggal_terbit" value="{{ old('tanggal_terbit', $berita->tanggal_terbit) }}" required>
                    @error('tanggal_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="isi" class="form-label fw-bold">Isi Berita <span class="text-danger">*</span></label>
                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="10" required>{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection
