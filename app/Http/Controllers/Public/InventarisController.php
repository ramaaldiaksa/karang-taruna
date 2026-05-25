<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inventaris;

class InventarisController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::orderBy('created_at', 'desc')->get()->map(function ($item) {
            $nama = strtolower($item->nama_barang);

            if (str_contains($nama, 'proyektor') || str_contains($nama, 'laptop') || str_contains($nama, 'speaker') || str_contains($nama, 'mikrofon') || str_contains($nama, 'kamera') || str_contains($nama, 'elektronik')) {
                $kategori = 'Elektronik';
            } elseif (str_contains($nama, 'kursi') || str_contains($nama, 'meja') || str_contains($nama, 'lemari') || str_contains($nama, 'rak') || str_contains($nama, 'mebel')) {
                $kategori = 'Mebel';
            } elseif (str_contains($nama, 'kompor') || str_contains($nama, 'panci') || str_contains($nama, 'wajan') || str_contains($nama, 'masak')) {
                $kategori = 'Alat Masak';
            } elseif (str_contains($nama, 'tenda') || str_contains($nama, 'terpal') || str_contains($nama, 'dekorasi')) {
                $kategori = 'Perlengkapan';
            } else {
                $kategori = 'Lainnya';
            }

            $item->kategori = $kategori;
            $item->status_label = $item->jumlah_tersedia > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $item->status_key = $item->jumlah_tersedia > 0 ? 'tersedia' : 'habis';
            $item->jumlah_dipinjam = max(0, (int) $item->jumlah_total - (int) $item->jumlah_tersedia);

            return $item;
        });

        $kategoriOptions = $inventaris->pluck('kategori')->unique()->sort()->values();
        $totalItem = (int) $inventaris->sum('jumlah_total');
        $totalTersedia = (int) $inventaris->sum('jumlah_tersedia');
        $totalDipinjam = max(0, $totalItem - $totalTersedia);
        $totalItemHabis = $inventaris->where('jumlah_tersedia', 0)->count();

        return view('public.inventaris', compact(
            'inventaris',
            'kategoriOptions',
            'totalItem',
            'totalTersedia',
            'totalDipinjam',
            'totalItemHabis'
        ));
    }
}
