@extends('layouts.public')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card border-0 shadow">
                <div class="card-header bg-white pt-4 pb-2 border-0 d-flex align-items-center">
                    <h3 class="mb-0 fw-bold text-primary"><i class="fas fa-handshake me-2"></i> Formulir Peminjaman Inventaris</h3>
                </div>
                <div class="card-body p-4 p-md-5 pt-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('public.peminjaman.store') }}" method="POST" id="form-peminjaman">
                        @csrf
                        
                        <!-- Progress Indicator -->
                        <div class="row text-center mb-5 mt-3 step-progress">
                            <div class="col-6 pb-3 step-indicator active-step text-start" id="indicator-step-1">
                                <h5 class="mb-0 fw-bold">Step 1: Identitas Peminjam</h5>
                            </div>
                            <div class="col-6 pb-3 step-indicator text-muted text-start" id="indicator-step-2">
                                <h5 class="mb-0">Step 2: Detail Barang & Peminjaman</h5>
                            </div>
                        </div>

                        <!-- Step 1 Content -->
                        <div id="step-1-content">
                            <h5 class="fw-bold mb-4">Informasi Peminjam</h5>
                            <div class="mb-3">
                                <label class="form-label text-dark">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control text-dark" value="{{ old('nama') }}" required>
                                <div class="form-text">Masukkan nama lengkap sesuai KTP.</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">No. Telepon / WhatsApp</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control text-dark" value="{{ old('no_telepon') }}" required>
                                    <div class="form-text">Nomor yang aktif untuk dihubungi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-dark">Email (Opsional)</label>
                                    <input type="email" name="email" id="email" class="form-control text-dark" value="{{ old('email') }}">
                                    <div class="form-text">Alamat email jika ada.</div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-dark">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control text-dark" rows="3" required>{{ old('alamat') }}</textarea>
                                <div class="form-text">Masukkan alamat tempat tinggal saat ini.</div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" id="btn-next" class="btn btn-primary px-4 shadow-sm">Berikutnya</button>
                            </div>
                        </div>

                        <!-- Step 2 Content -->
                        <div id="step-2-content" style="display: none;">
                            <h5 class="fw-bold mb-4">Detail Peminjaman</h5>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="form-label text-dark">Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control text-dark" value="{{ old('tanggal_pinjam') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Rencana Kembali</label>
                                    <input type="date" name="rencana_kembali" class="form-control text-dark" value="{{ old('rencana_kembali') }}" required>
                                </div>
                            </div>

                            <div class="card bg-light border-0 mb-4">
                                <div class="card-body p-4">
                                    <label class="form-label fw-bold mb-3 text-dark">Daftar Barang yang Dipinjam</label>
                                    
                                    <div id="barang-container">
                                        {{-- Baris Barang Pertama (Default) --}}
                                        <div class="row align-items-end mb-3 barang-item">
                                            <div class="col-md-2 col-4 mb-2 mb-md-0">
                                                <label class="form-label small text-muted">Jumlah</label>
                                                <input type="number" name="jumlah_pinjam[]" class="form-control text-dark text-center" min="1" value="1" required>
                                            </div>
                                            <div class="col-md-9 col-6 mb-2 mb-md-0">
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
                                            <div class="col-md-1 col-2 text-center mb-2 mb-md-0">
                                                <button type="button" class="btn btn-outline-danger btn-remove border-0" tabindex="-1"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary btn-sm w-100 mt-2 border-dashed">
                                        <i class="fas fa-plus me-1"></i> Tambah Barang Lain
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" id="btn-prev" class="btn btn-outline-secondary px-4">Sebelumnya</button>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Kirim Pengajuan</button>
                            </div>
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

    // Step logic
    const step1 = document.getElementById('step-1-content');
    const step2 = document.getElementById('step-2-content');
    const ind1 = document.getElementById('indicator-step-1');
    const ind2 = document.getElementById('indicator-step-2');
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');

    btnNext.addEventListener('click', function() {
        const nama = document.getElementById('nama');
        const telp = document.getElementById('no_telepon');
        const alamat = document.getElementById('alamat');
        
        if(!nama.checkValidity() || !telp.checkValidity() || !alamat.checkValidity()) {
            document.getElementById('form-peminjaman').reportValidity();
            return;
        }
        
        step1.style.display = 'none';
        step2.style.display = 'block';
        ind1.classList.remove('active-step');
        ind1.classList.add('text-muted');
        ind1.querySelector('h5').classList.remove('text-primary');
        ind1.querySelector('h5').classList.remove('fw-bold');
        
        ind2.classList.add('active-step');
        ind2.classList.remove('text-muted');
        ind2.querySelector('h5').classList.add('text-primary');
        ind2.querySelector('h5').classList.add('fw-bold');
    });

    btnPrev.addEventListener('click', function() {
        step2.style.display = 'none';
        step1.style.display = 'block';
        
        ind2.classList.remove('active-step');
        ind2.classList.add('text-muted');
        ind2.querySelector('h5').classList.remove('text-primary');
        ind2.querySelector('h5').classList.remove('fw-bold');
        
        ind1.classList.add('active-step');
        ind1.classList.remove('text-muted');
        ind1.querySelector('h5').classList.add('text-primary');
        ind1.querySelector('h5').classList.add('fw-bold');
    });

    // Peminjaman items logic
    function updateSelectOptions() {
        const selects = document.querySelectorAll('select[name="id_inventaris[]"]');
        const selectedValues = Array.from(selects).map(s => s.value).filter(v => v !== "");
        
        selects.forEach(select => {
            const currentValue = select.value;
            Array.from(select.options).forEach(option => {
                if (option.value !== "") {
                    if (selectedValues.includes(option.value) && option.value !== currentValue) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                }
            });
        });
    }

    container.addEventListener('change', function(e) {
        if(e.target.tagName.toLowerCase() === 'select') {
            updateSelectOptions();
        }
    });

    btnTambah.addEventListener('click', function() {
        const firstItem = container.querySelector('.barang-item');
        const newItem = firstItem.cloneNode(true);
        newItem.querySelector('input[type="number"]').value = 1;
        newItem.querySelector('select').value = "";
        container.appendChild(newItem);
        updateSelectOptions();
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove')) {
            const items = container.querySelectorAll('.barang-item');
            if(items.length > 1) {
                e.target.closest('.barang-item').remove();
                updateSelectOptions();
            } else {
                alert('Minimal harus ada satu barang yang dipinjam!');
            }
        }
    });

    updateSelectOptions();
    
    // Set default initial active step styling
    ind1.querySelector('h5').classList.add('text-primary');
});
</script>

<style>
.border-dashed {
    border-style: dashed !important;
}
.step-indicator {
    border-bottom: 4px solid #e9ecef;
    transition: all 0.3s;
}
.step-indicator.active-step {
    border-bottom: 4px solid var(--bs-primary);
}
.step-indicator h5 { 
    transition: all 0.3s;
    font-size: 1.1rem;
}
</style>
@endsection
