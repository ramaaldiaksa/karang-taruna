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
        $peminjamans = Peminjaman::with(['masyarakat', 'detail.inventaris'])->orderBy('created_at', 'desc')->get();
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
