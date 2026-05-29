<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Http\Requests\KeuanganRequest;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Keuangan::with('admin')->orderBy('tanggal', 'desc');

        if ($request->filled('q')) {
            $query->where('keterangan', 'like', "%{$request->q}%");
        }

        if ($request->filled('jenis_transaksi')) {
            $query->where('jenis_transaksi', $request->jenis_transaksi);
        }

        $keuangans = $query->paginate(10)->withQueryString();
        $totalPemasukan = Keuangan::where('jenis_transaksi', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis_transaksi', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;
        
        return view('admin.keuangan.index', compact('keuangans', 'totalPemasukan', 'totalPengeluaran', 'saldoKas'));
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
