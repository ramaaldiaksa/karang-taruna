@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<x-admin.toolbar :action="route('admin.berita.index')" class="admin-toolbar admin-toolbar--two">
    <x-admin.search-input placeholder="Cari Judul atau Penulis..." />
    <x-admin.button :href="route('admin.berita.create')" icon="fas fa-plus-circle">Tambah Berita</x-admin.button>
</x-admin.toolbar>

<x-admin.table-card :paginator="$beritas">
    @if($beritas->count() === 0)
        <div class="admin-table-empty">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <p class="mb-0">Belum ada data berita.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 15%;">Gambar</th>
                        <th>Judul</th>
                        <th style="width: 18%;">Tanggal Terbit</th>
                        <th class="text-center" style="width: 12%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beritas as $berita)
                    <tr>
                        <td>{{ $beritas->firstItem() + $loop->index }}</td>
                        <td>
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                            @else
                                <span class="admin-table__muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $berita->judul }}</div>
                            <small class="admin-table__muted">{{ Str::limit(strip_tags($berita->isi), 50) }}</small>
                        </td>
                        <td class="admin-table__muted">{{ \Carbon\Carbon::parse($berita->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                        <td class="text-center">
                            <x-admin.icon-action :href="route('admin.berita.edit', $berita->id)" title="Edit berita" />
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <x-admin.icon-action type="submit" variant="delete" title="Hapus berita" />
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-admin.table-card>
@endsection
