<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Inventaris;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['masyarakat', 'detail.inventaris'])
            ->when(request('q'), function ($query, $search) {
                $query->whereHas('masyarakat', function ($builder) use ($search) {
                    $builder->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_telepon', 'like', "%{$search}%");
                });
            })
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function verifikasiForm($id)
    {
        $peminjaman = Peminjaman::with(['masyarakat', 'detail.inventaris'])->findOrFail($id);
        return view('admin.peminjaman.verifikasi', compact('peminjaman'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:disetujui,ditolak']);
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($request->status == 'disetujui' && $peminjaman->status == 'menunggu') {
            // Update stok
            foreach ($peminjaman->detail as $dt) {
                $inv = $dt->inventaris;
                if ($inv->jumlah_tersedia >= $dt->jumlah_pinjam) {
                    $inv->decrement('jumlah_tersedia', $dt->jumlah_pinjam);
                } else {
                    return back()->with('error', 'Stok barang tidak mencukupi untuk ' . $inv->nama_barang);
                }
            }
        }

        $peminjaman->update([
            'status' => $request->status,
            'id_admin' => auth()->id()
        ]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
