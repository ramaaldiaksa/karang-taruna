<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Http\Requests\KeuanganRequest;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangans = Keuangan::with('admin')->orderBy('tanggal', 'desc')->get();
        $totalPemasukan = $keuangans->where('jenis_transaksi', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $keuangans->where('jenis_transaksi', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;
        
        return view('admin.keuangan.index', compact('keuangans', 'totalPemasukan', 'totalPengeluaran', 'saldoKas'));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(KeuanganRequest $request)
    {
        $data = $request->validated();
        $data['id_admin'] = auth()->id();

        if ($request->hasFile('bukti_transaksi')) {
            $data['bukti_transaksi'] = $request->file('bukti_transaksi')->store('bukti_transaksi', 'public');
        }

        Keuangan::create($data);
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi keuangan berhasil dicatat.');
    }

    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
