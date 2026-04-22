@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="fas fa-plus me-2 text-primary"></i> Tambah Berita Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul berita...">
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="gambar" class="form-label fw-bold">Gambar/Cover <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" required>
                    <div class="form-text">Format yang didukung: JPG, PNG, GIF. Maksimal ukuran: 2MB.</div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="penulis" class="form-label fw-bold">Ditulis Oleh <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}" required placeholder="Nama penulis...">
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="tanggal_terbit" class="form-label fw-bold">Tanggal Terbit <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror" id="tanggal_terbit" name="tanggal_terbit" value="{{ old('tanggal_terbit', date('Y-m-d')) }}" required>
                    @error('tanggal_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <label for="isi" class="form-label fw-bold">Isi Berita <span class="text-danger">*</span></label>
                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="10" required placeholder="Tuliskan isi berita di sini...">{{ old('isi') }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection
