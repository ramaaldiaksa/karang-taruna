<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventaris;
use App\Models\Masyarakat;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Http\Requests\PeminjamanRequest;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    public function create()
    {
        $inventaris = Inventaris::where('jumlah_tersedia', '>', 0)->get();
        $idempotencyToken = Str::uuid()->toString();
        session()->put('peminjaman_token', $idempotencyToken);

        return view('public.peminjaman.create', compact('inventaris', 'idempotencyToken'));
    }

    public function store(PeminjamanRequest $request)
    {
        // Validasi Idempotency Token
        $token = $request->input('idempotency_token');
        $sessionToken = session()->get('peminjaman_token');

        if (!$token || $token !== $sessionToken) {
            return redirect()->route('home')->with('warning', 'Transaksi duplikat telah diblokir. Pengajuan Anda sedang diproses.');
        }

        // Hapus token secara instan dari session sebelum menulis ke DB
        session()->forget('peminjaman_token');

        // 1. Simpan/Update Masyarakat (Berdasarkan email atau telepon)
        $masyarakat = Masyarakat::firstOrCreate(
            ['no_telepon' => $request->no_telepon],
            [
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]
        );

        // 2. Buat Data Peminjaman
        $peminjaman = Peminjaman::create([
            'id_masyarakat' => $masyarakat->id_masyarakat,
            'tanggal_pengajuan' => now()->toDateString(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'rencana_kembali' => $request->rencana_kembali,
            'status' => 'menunggu'
        ]);

        // 3. Buat Detail Peminjaman (Gabungkan jika ada barang yang sama dipilih 2x)
        $mergedItems = [];
        foreach ($request->id_inventaris as $index => $id_inv) {
            if (isset($mergedItems[$id_inv])) {
                $mergedItems[$id_inv] += $request->jumlah_pinjam[$index];
            } else {
                $mergedItems[$id_inv] = $request->jumlah_pinjam[$index];
            }
        }

        foreach ($mergedItems as $id_inv => $jumlah) {
            DetailPeminjaman::create([
                'id_peminjaman' => $peminjaman->id_peminjaman,
                'id_inventaris' => $id_inv,
                'jumlah_pinjam' => $jumlah,
                'kondisi_pinjam' => 'baik'
            ]);
        }


        // Note: Stok inventaris akan dikurangi setelah disetujui Admin, bukan saat pengajuan.

        return redirect()->route('public.peminjaman.success', $peminjaman->id_peminjaman);
    }

    public function success($id)
    {
        $peminjaman = Peminjaman::with(['masyarakat', 'detail.inventaris'])->findOrFail($id);
        return view('public.peminjaman.success', compact('peminjaman'));
    }
}
