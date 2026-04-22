<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('tanggal_terbit', '<=', now()->toDateString())
                    ->latest('tanggal_terbit')
                    ->paginate(9);
        return view('public.berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
                    ->where('tanggal_terbit', '<=', now()->toDateString())
                    ->firstOrFail();
        return view('public.berita.show', compact('berita'));
    }
}
