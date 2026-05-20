<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Peminjaman;
use App\Models\Inventaris;
use App\Models\Keuangan;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();
        $peminjamanMenunggu = Peminjaman::where('status', 'menunggu')->count();
        $totalInventaris = Inventaris::count();
        $totalKeuangan = Keuangan::count();
        $totalSuratMasuk = Surat::where('jenis_surat', 'surat masuk')->count();
        $totalSuratKeluar = Surat::where('jenis_surat', 'surat keluar')->count();
        $totalSurat = $totalSuratMasuk + $totalSuratKeluar;

        $peminjamanTerbaru = Peminjaman::with(['masyarakat', 'detail.inventaris'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Tren Peminjaman Bulanan (6 bulan terakhir)
        $tahunSekarang = Carbon::now()->year;
        $trenPeminjaman = [];
        for ($i = 1; $i <= 6; $i++) {
            $trenPeminjaman[] = Peminjaman::whereYear('tanggal_pengajuan', $tahunSekarang)
                ->whereMonth('tanggal_pengajuan', $i)
                ->count();
        }

        // Statistik Keuangan
        $totalPemasukan = Keuangan::where('jenis_transaksi', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis_transaksi', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Kategori Inventaris (group by nama_barang keyword)
        $inventarisItems = Inventaris::all();
        $kategoriInventaris = $inventarisItems->groupBy(function ($item) {
            $nama = strtolower($item->nama_barang);
            if (str_contains($nama, 'proyektor') || str_contains($nama, 'laptop') || str_contains($nama, 'speaker') || str_contains($nama, 'mikrofon') || str_contains($nama, 'kamera') || str_contains($nama, 'elektronik')) {
                return 'Elektronik';
            } elseif (str_contains($nama, 'kursi') || str_contains($nama, 'meja') || str_contains($nama, 'lemari') || str_contains($nama, 'rak') || str_contains($nama, 'mebel')) {
                return 'Mebel';
            } elseif (str_contains($nama, 'kompor') || str_contains($nama, 'panci') || str_contains($nama, 'wajan') || str_contains($nama, 'masak')) {
                return 'Alat Masak';
            } elseif (str_contains($nama, 'tenda') || str_contains($nama, 'terpal') || str_contains($nama, 'dekorasi')) {
                return 'Perlengkapan';
            } else {
                return 'Lainnya';
            }
        })->map->count();

        return view('admin.dashboard', compact(
            'totalPeminjaman',
            'peminjamanMenunggu',
            'totalInventaris',
            'totalKeuangan',
            'totalSurat',
            'totalSuratMasuk',
            'totalSuratKeluar',
            'peminjamanTerbaru',
            'trenPeminjaman',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir',
            'kategoriInventaris',
            'tahunSekarang'
        ));
    }
}
