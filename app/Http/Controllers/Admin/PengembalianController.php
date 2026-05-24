<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Http\Requests\PengembalianRequest;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('status', 'disetujui')
            ->with('masyarakat')
            ->when(request('q'), function ($query, $search) {
                $query->whereHas('masyarakat', function ($builder) use ($search) {
                    $builder->where('nama', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $pengembalians_count = Pengembalian::count();
        return view('admin.pengembalian.index', compact('peminjamans', 'pengembalians_count'));
    }

    public function riwayat()
    {
        $pengembalians = Pengembalian::with(['peminjaman.masyarakat', 'admin'])
            ->when(request('q'), function ($query, $search) {
                $query->whereHas('peminjaman.masyarakat', function ($builder) use ($search) {
                    $builder->where('nama', 'like', "%{$search}%");
                });
            })
            ->orderBy('tanggal_kembali', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.pengembalian.riwayat', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::where('status', 'disetujui')
            ->with('masyarakat')
            ->get();
        return view('admin.pengembalian.create', compact('peminjamans'));
    }

    public function store(PengembalianRequest $request)
    {
        $peminjaman = Peminjaman::findOrFail($request->id_peminjaman);

        Pengembalian::create([
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'id_admin' => auth()->id(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'keterangan' => $request->keterangan
        ]);

        $peminjaman->update(['status' => 'dikembalikan']);

        // Kembalikan stok
        foreach ($peminjaman->detail as $dt) {
            $dt->inventaris->increment('jumlah_tersedia', $dt->jumlah_pinjam);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil dicatat dan stok inventaris dikembalikan.');
    }
}
