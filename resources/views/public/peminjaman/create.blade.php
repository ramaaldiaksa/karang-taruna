@extends('layouts.public')

@section('content')
<div class="container py-5 mt-3 mb-5">
    
    <!-- Stepper -->
    <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center position-relative">
                <!-- Line Base -->
                <div class="position-absolute" style="top: 15px; left: 10%; right: 10%; height: 2px; background-color: #e9ecef; z-index: 1;"></div>
                
                <!-- Line Active (Will be updated via JS) -->
                <div id="step-line-active" class="position-absolute" style="top: 15px; left: 10%; width: 0%; height: 2px; background-color: var(--bs-primary); z-index: 1; transition: width 0.3s ease;"></div>
                
                <!-- Step 1 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;" id="indicator-step-1">
                    <div class="step-circle rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2 shadow-sm" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem; transition: all 0.3s;">
                        1
                    </div>
                    <span class="step-text text-primary fw-semibold" style="font-size: 0.85rem; transition: all 0.3s;">Data Diri</span>
                </div>

                <!-- Step 2 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;" id="indicator-step-2">
                    <div class="step-circle rounded-circle bg-light-gray text-muted border d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem; transition: all 0.3s;">
                        2
                    </div>
                    <span class="step-text text-muted fw-medium" style="font-size: 0.85rem; transition: all 0.3s;">Detail Barang</span>
                </div>

                <!-- Step 3 -->
                <div class="text-center position-relative z-index-2" style="background: white; padding: 0 10px; z-index: 2;" id="indicator-step-3">
                    <div class="step-circle rounded-circle bg-light-gray text-muted border d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.9rem; transition: all 0.3s;">
                        3
                    </div>
                    <span class="step-text text-muted fw-medium" style="font-size: 0.85rem; transition: all 0.3s;">Konfirmasi Selesai</span>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4" style="border-radius: 8px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('public.peminjaman.store') }}" method="POST" id="form-peminjaman">
        @csrf
        <div class="row g-4">
            
            <!-- Main Content Form -->
            <div class="col-lg-8">
                <div class="card border shadow-sm h-100" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important;">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Step 1 Content -->
                        <div id="step-1-content">
                            <h4 class="fw-semibold mb-2 text-dark">Identitas Peminjam</h4>
                            <p class="text-muted mb-5" style="font-size: 0.95rem;">Lengkapi data diri Anda untuk melakukan pengajuan peminjaman inventaris.</p>
                            
                            <div class="mb-4">
                                <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control form-control-lg bg-light-gray border-0" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap sesuai KTP" style="font-size: 0.95rem;" required>
                            </div>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">No. WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light-gray border-0 text-muted">+62</span>
                                        <input type="text" name="no_telepon" id="no_telepon" class="form-control form-control-lg bg-light-gray border-0 ps-2" value="{{ old('no_telepon') }}" placeholder="812xxx" style="font-size: 0.95rem;" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Email Aktif</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light-gray border-0" value="{{ old('email') }}" placeholder="contoh@email.com" style="font-size: 0.95rem;" required>
                                </div>
                            </div>
                            
                            <div class="mb-5">
                                <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Alamat Domisili</label>
                                <textarea name="alamat" id="alamat" class="form-control bg-light-gray border-0" rows="4" placeholder="Jl. Merpati No. 12, RT 01/RW 02..." style="font-size: 0.95rem;" required>{{ old('alamat') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" id="btn-next" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 6px; font-weight: 500;">
                                    Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2 Content -->
                        <div id="step-2-content" style="display: none;">
                            <h4 class="fw-semibold mb-5 text-dark">Informasi Peminjaman</h4>
                            
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Tanggal Peminjaman</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control form-control-lg border" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" style="font-size: 0.95rem;" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Tanggal Pengembalian</label>
                                    <input type="date" name="rencana_kembali" class="form-control form-control-lg border" value="{{ old('rencana_kembali', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" style="font-size: 0.95rem;" required>
                                </div>
                            </div>

                            <div id="barang-container">
                                <div class="barang-item mb-4">
                                    <div class="mb-3">
                                        <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Pilih Inventaris</label>
                                        <select name="id_inventaris[]" class="form-select form-select-lg border" style="font-size: 0.95rem;" required>
                                            <option value="">Pilih barang yang ingin dipinjam...</option>
                                            @foreach($inventaris as $item)
                                                <option value="{{ $item->id_inventaris }}">
                                                    {{ $item->nama_barang }} (Tersedia: {{ $item->jumlah_tersedia }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-10">
                                            <label class="form-label text-dark fw-medium" style="font-size: 0.9rem;">Jumlah Barang</label>
                                            <input type="number" name="jumlah_pinjam[]" class="form-control form-control-lg border" min="1" value="1" placeholder="Masukkan jumlah unit" style="font-size: 0.95rem;" required>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <button type="button" class="btn btn-outline-danger btn-remove border-0" tabindex="-1"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="btn-tambah-barang" class="btn btn-outline-primary btn-sm mt-1 mb-5" style="border-style: dashed; border-radius: 6px;">
                                <i class="fas fa-plus me-1"></i> Tambah Barang Lain
                            </button>

                            <div class="d-flex justify-content-between pt-4 border-top">
                                <button type="button" id="btn-prev" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 6px; font-weight: 500;">
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 6px; font-weight: 500;">
                                    Lanjutkan Ke Konfirmasi
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                
                <!-- Sidebar Step 1 -->
                <div id="sidebar-step-1">
                    <div class="card border shadow-sm mb-4" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important; background-color: #fcfcfc;">
                        <div class="card-body p-4">
                            <h6 class="text-dark fw-semibold mb-4 d-flex align-items-center">
                                <i class="fas fa-gavel text-primary me-2"></i> Ketentuan Peminjaman
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="far fa-check-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Peminjam wajib merupakan warga atau anggota Karang Taruna setempat.</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="far fa-check-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Menyertakan identitas diri (KTP/SIM) sebagai jaminan saat pengambilan barang.</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="far fa-check-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Barang yang rusak atau hilang selama masa peminjaman menjadi tanggung jawab penuh peminjam.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="far fa-check-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Pengajuan harus dilakukan minimal 3 hari sebelum waktu pemakaian.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm" style="border-radius: 12px; background-color: #e9ecef;">
                        <div class="card-body p-4">
                            <p class="text-muted mb-0" style="font-size: 0.85rem; line-height: 1.6;">
                                Butuh bantuan lebih lanjut? Hubungi Admin Karang Taruna melalui menu <strong class="text-dark">Bantuan</strong> di bilah navigasi utama.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Step 2 -->
                <div id="sidebar-step-2" style="display: none;">
                    <div class="card border shadow-sm mb-4" style="border-radius: 12px; border-color: rgba(0,0,0,0.08) !important; background-color: #fcfcfc;">
                        <div class="card-body p-4">
                            <h6 class="text-dark fw-semibold mb-4 d-flex align-items-center">
                                <i class="fas fa-gavel text-primary me-2"></i> Ketentuan Peminjaman
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="far fa-info-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Peminjaman maksimal dilakukan 3 hari sebelum penggunaan.</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <i class="far fa-info-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Barang yang dipinjam harus dikembalikan dalam keadaan bersih.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="far fa-info-circle text-primary mt-1 me-3"></i>
                                    <span class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">Segala kerusakan menjadi tanggung jawab peminjam sepenuhnya.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm" style="border-radius: 12px; background-color: #e8f0fe;">
                        <div class="card-body p-4">
                            <h6 class="text-primary fw-semibold mb-3 d-flex align-items-center">
                                <i class="fas fa-headset me-2"></i> Butuh Bantuan?
                            </h6>
                            <p class="text-muted mb-4" style="font-size: 0.85rem; line-height: 1.6;">
                                Jika Anda mengalami kesulitan saat pengisian form, silakan hubungi pengurus RT/RW atau Admin Karang Taruna.
                            </p>
                            <a href="#" class="btn bg-white text-primary w-100 fw-medium shadow-sm border" style="border-radius: 6px;">
                                <i class="far fa-comment-dots me-2"></i> Hubungi Admin
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('barang-container');
    const btnTambah = document.getElementById('btn-tambah-barang');

    // Step logic
    const step1 = document.getElementById('step-1-content');
    const step2 = document.getElementById('step-2-content');
    const sidebar1 = document.getElementById('sidebar-step-1');
    const sidebar2 = document.getElementById('sidebar-step-2');
    
    const ind1 = document.getElementById('indicator-step-1');
    const ind2 = document.getElementById('indicator-step-2');
    const lineActive = document.getElementById('step-line-active');
    
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');

    function updateStepper(step) {
        if(step === 1) {
            // Circle 1
            ind1.querySelector('.step-circle').innerHTML = '1';
            ind1.querySelector('.step-circle').classList.replace('bg-light-gray', 'bg-primary');
            ind1.querySelector('.step-circle').classList.replace('text-muted', 'text-white');
            ind1.querySelector('.step-circle').classList.remove('border');
            ind1.querySelector('.step-text').classList.replace('text-muted', 'text-primary');
            ind1.querySelector('.step-text').classList.replace('fw-medium', 'fw-semibold');
            
            // Circle 2
            ind2.querySelector('.step-circle').classList.replace('bg-primary', 'bg-light-gray');
            ind2.querySelector('.step-circle').classList.replace('text-white', 'text-muted');
            ind2.querySelector('.step-circle').classList.add('border');
            ind2.querySelector('.step-text').classList.replace('text-primary', 'text-muted');
            ind2.querySelector('.step-text').classList.replace('fw-semibold', 'fw-medium');
            
            lineActive.style.width = '0%';
        } else if(step === 2) {
            // Circle 1 becomes checkmark
            ind1.querySelector('.step-circle').innerHTML = '<i class="fas fa-check"></i>';
            ind1.querySelector('.step-circle').classList.replace('bg-light-gray', 'bg-primary');
            ind1.querySelector('.step-circle').classList.replace('text-muted', 'text-white');
            ind1.querySelector('.step-circle').classList.remove('border');
            ind1.querySelector('.step-text').classList.replace('text-muted', 'text-primary');
            ind1.querySelector('.step-text').classList.replace('fw-medium', 'fw-semibold');
            
            // Circle 2 becomes active
            ind2.querySelector('.step-circle').classList.replace('bg-light-gray', 'bg-primary');
            ind2.querySelector('.step-circle').classList.replace('text-muted', 'text-white');
            ind2.querySelector('.step-circle').classList.remove('border');
            ind2.querySelector('.step-text').classList.replace('text-muted', 'text-primary');
            ind2.querySelector('.step-text').classList.replace('fw-medium', 'fw-semibold');
            
            lineActive.style.width = '40%';
        }
    }

    btnNext.addEventListener('click', function() {
        const nama = document.getElementById('nama');
        const telp = document.getElementById('no_telepon');
        const alamat = document.getElementById('alamat');
        
        if(!nama.checkValidity() || !telp.checkValidity() || !alamat.checkValidity()) {
            document.getElementById('form-peminjaman').reportValidity();
            return;
        }
        
        step1.style.display = 'none';
        sidebar1.style.display = 'none';
        step2.style.display = 'block';
        sidebar2.style.display = 'block';
        
        updateStepper(2);
    });

    btnPrev.addEventListener('click', function() {
        step2.style.display = 'none';
        sidebar2.style.display = 'none';
        step1.style.display = 'block';
        sidebar1.style.display = 'block';
        
        updateStepper(1);
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
        
        // Wrap new item in an hr to separate or just add margin
        const hr = document.createElement('hr');
        hr.className = "text-muted opacity-25 my-4";
        container.appendChild(hr);
        container.appendChild(newItem);
        
        updateSelectOptions();
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove')) {
            const items = container.querySelectorAll('.barang-item');
            if(items.length > 1) {
                const itemToRemove = e.target.closest('.barang-item');
                // Remove the hr before it if exists
                if(itemToRemove.previousElementSibling && itemToRemove.previousElementSibling.tagName.toLowerCase() === 'hr') {
                    itemToRemove.previousElementSibling.remove();
                }
                itemToRemove.remove();
                updateSelectOptions();
            } else {
                alert('Minimal harus ada satu barang yang dipinjam!');
            }
        }
    });

    updateSelectOptions();
});
</script>
@endsection
