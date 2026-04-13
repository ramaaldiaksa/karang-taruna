@extends('layouts.admin')
@section('title', 'Proses Pengembalian')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengembalian.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Pilih Transaksi Peminjaman</label>
                <select name="id_peminjaman" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($peminjamans as $p)
                        <option value="{{ $p->id_peminjaman }}">{{ $p->masyarakat->nama ?? '-' }} - #{{ $p->id_peminjaman }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tgl. Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Catat Pengembalian</button>
        </form>
    </div>
</div>
@endsection
