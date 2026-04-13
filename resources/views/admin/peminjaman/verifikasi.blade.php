@extends('layouts.admin')
@section('title', 'Verifikasi Peminjaman')
@section('content')
<div class="card">
    <div class="card-body">
        <h5>Detail Peminjaman: {{ $peminjaman->masyarakat->nama }}</h5>
        <form action="{{ route('admin.peminjaman.verifikasi', $peminjaman->id_peminjaman) }}" method="POST">
            @csrf
            <div class="mb-3 mt-4">
                <label>Status Keputusan</label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="disetujui">Setujui Peminjaman</option>
                    <option value="ditolak">Tolak Peminjaman</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Simpan Keputusan</button>
        </form>
    </div>
</div>
@endsection
