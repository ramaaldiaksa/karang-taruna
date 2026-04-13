<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventaris;
use App\Models\Masyarakat;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Http\Requests\PeminjamanRequest;

class PeminjamanController extends Controller
{
    public function create()
    {
        $inventaris = Inventaris::where('jumlah_tersedia', '>', 0)->get();
        return view('public.peminjaman.create', compact('inventaris'));
    }

    public function store(PeminjamanRequest $request)
    {
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

        return redirect()->route('public.inventaris')->with('success', 'Pengajuan peminjaman berhasil dikirim. Silakan tunggu verifikasi dari Admin.');
    }
}
