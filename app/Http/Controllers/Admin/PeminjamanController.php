<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Inventaris;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\StatusPeminjamanMail;

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
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:disetujui,ditolak']);
        $peminjaman = Peminjaman::findOrFail($id);

        try {
            DB::transaction(function () use ($request, $peminjaman) {
                if ($request->status == 'disetujui' && $peminjaman->status == 'menunggu') {
                    // Update stok
                    foreach ($peminjaman->detail as $dt) {
                        $inv = $dt->inventaris;
                        if ($inv->jumlah_tersedia >= $dt->jumlah_pinjam) {
                            $inv->decrement('jumlah_tersedia', $dt->jumlah_pinjam);
                        } else {
                            throw new \Exception('Stok barang tidak mencukupi untuk ' . $inv->nama_barang);
                        }
                    }
                }

                $peminjaman->update([
                    'status' => $request->status,
                    'id_admin' => auth()->id()
                ]);
            });

            // Kirim email notifikasi setelah transaksi database sukses berkomitmen
            if ($peminjaman->masyarakat && $peminjaman->masyarakat->email) {
                try {
                    Mail::to($peminjaman->masyarakat->email)->send(new StatusPeminjamanMail($peminjaman));
                } catch (\Exception $mailException) {
                    // Log error pengiriman email agar proses approval tetap sukses berjalan lancar
                    Log::error("Gagal mengirim email status peminjaman #{$peminjaman->id_peminjaman} ke {$peminjaman->masyarakat->email}: " . $mailException->getMessage());
                }
            }

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
