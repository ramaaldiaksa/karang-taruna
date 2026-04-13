<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Peminjaman;
use App\Models\Inventaris;
use App\Models\Keuangan;
use App\Models\Surat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();
        $peminjamanMenunggu = Peminjaman::where('status', 'menunggu')->count();
        $totalInventaris = Inventaris::count();
        $totalKeuangan = Keuangan::count();
        $totalSurat = Surat::count();

        $peminjamanTerbaru = Peminjaman::with(['masyarakat', 'detail.inventaris'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPeminjaman', 
            'peminjamanMenunggu', 
            'totalInventaris', 
            'totalKeuangan', 
            'totalSurat',
            'peminjamanTerbaru'
        ));
    }
}
