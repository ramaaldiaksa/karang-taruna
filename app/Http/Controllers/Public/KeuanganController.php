<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Keuangan;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::orderBy('tanggal', 'desc')->get();
        $totalPemasukan = Keuangan::where('jenis_transaksi', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis_transaksi', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('public.keuangan', compact('keuangan', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }
}
