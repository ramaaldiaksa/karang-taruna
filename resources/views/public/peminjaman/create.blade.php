@extends('layouts.public')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-handshake me-2"></i>Formulir Peminjaman Inventaris</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('public.peminjaman.store') }}" method="POST">
                        @csrf
                        
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Informasi Peminjam</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control text-dark" value="{{ old('nama') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon / WhatsApp</label>
                                <input type="text" name="no_telepon" class="form-control text-dark" value="{{ old('no_telepon') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Opsional)</label>
                                <input type="email" name="email" class="form-control text-dark" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control text-dark" rows="2" required>{{ old('alamat') }}</textarea>
                        </div>

                        <h5 class="fw-bold mb-3 border-bottom pb-2 mt-4">Detail Peminjaman</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control text-dark" value="{{ old('tanggal_pinjam') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rencana Kembali</label>
                                <input type="date" name="rencana_kembali" class="form-control text-dark" value="{{ old('rencana_kembali') }}" required>
                            </div>
                        </div>

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body p-3">
                                <label class="form-label fw-bold mb-3">Daftar Barang yang Dipinjam</label>
                                
                                <div id="barang-container">
                                    {{-- Baris Barang Pertama (Default) --}}
                                    <div class="row align-items-end mb-3 barang-item">
                                        <div class="col-md-2 col-4">
                                            <label class="form-label small text-muted">Jumlah</label>
                                            <input type="number" name="jumlah_pinjam[]" class="form-control text-dark text-center" min="1" value="1" required>
                                        </div>
                                        <div class="col-md-9 col-6">
                                            <label class="form-label small text-muted">Nama Barang</label>
                                            <select name="id_inventaris[]" class="form-select text-dark" required>
                                                <option value="">Pilih Barang...</option>
                                                @foreach($inventaris as $item)
                                                    <option value="{{ $item->id_inventaris }}">
                                                        {{ $item->nama_barang }} (Tersedia: {{ $item->jumlah_tersedia }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1 col-2 text-center">
                                            <button type="button" class="btn btn-outline-danger btn-remove text-danger border-0"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary btn-sm w-100 mt-2 border-dashed">
                                    <i class="fas fa-plus me-1"></i> Tambah Barang
                                </button>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">Kirim Pengajuan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('barang-container');
    const btnTambah = document.getElementById('btn-tambah-barang');

    function updateSelectOptions() {
        // Ambil semua dropdown barang
        const selects = document.querySelectorAll('select[name="id_inventaris[]"]');
        
        // Kumpulkan semua value yang sudah terpilih (dan tidak kosong)
        const selectedValues = Array.from(selects).map(s => s.value).filter(v => v !== "");
        
        selects.forEach(select => {
            const currentValue = select.value;
            Array.from(select.options).forEach(option => {
                if (option.value !== "") {
                    // Disable opsi jika value-nya sudah ada di dropdown lain
                    if (selectedValues.includes(option.value) && option.value !== currentValue) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                }
            });
        });
    }

    // Panggil setiap kali ada perubahan pilihan barang
    container.addEventListener('change', function(e) {
        if(e.target.tagName.toLowerCase() === 'select') {
            updateSelectOptions();
        }
    });

    btnTambah.addEventListener('click', function() {
        // Clone the first item
        const firstItem = container.querySelector('.barang-item');
        const newItem = firstItem.cloneNode(true);
        
        // Reset values
        newItem.querySelector('input[type="number"]').value = 1;
        newItem.querySelector('select').value = "";
        
        container.appendChild(newItem);
        updateSelectOptions();
    });

    // Delegate event listener for dynamically added remove buttons
    container.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove')) {
            const items = container.querySelectorAll('.barang-item');
            if(items.length > 1) {
                e.target.closest('.barang-item').remove();
                updateSelectOptions(); // Update kembali daftar yang di-disable karena barang telah dihapus
            } else {
                alert('Minimal harus ada satu barang yang dipinjam!');
            }
        }
    });

    // Initial run in case form is loaded with old inputs
    updateSelectOptions();
});
</script>

<style>
.border-dashed {
    border-style: dashed !important;
}
</style>
@endsection
