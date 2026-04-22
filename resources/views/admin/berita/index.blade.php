@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="fas fa-newspaper me-2 text-primary"></i> Daftar Berita</h5>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Berita
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th>Judul</th>
                        <th width="15%">Tanggal Terbit</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark">{{ $berita->judul }}</strong><br>
                            <small class="text-muted">{{ Str::limit(strip_tags($berita->isi), 50) }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-newspaper fa-3x mb-3 text-light"></i>
                            <p class="mb-0">Belum ada data berita.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
